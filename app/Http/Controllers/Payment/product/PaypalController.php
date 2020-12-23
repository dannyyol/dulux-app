<?php

namespace App\Http\Controllers\Payment\product;

use App\Events\OrderPlaced;
use Illuminate\Http\Request;
use App\Http\Controllers\Payment\product\PaymentController;
use App\Http\Helpers\MegaMailer;
use App\Models\Language;
use Illuminate\Support\Str;
use App\Models\ProductOrder;
use App\Models\ShippingCharge;
use App\Models\PaymentGateway;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use Auth;


class PaypalController extends PaymentController
{

    private $_api_context;
    public function __construct()
    {
        $this->middleware('setlang');
        $data = PaymentGateway::whereKeyword('paypal')->first();
        $paydata = $data->convertAutoData();
        $paypal_conf = \Config::get('paypal');
        $paypal_conf['client_id'] = $paydata['client_id'];
        $paypal_conf['secret'] = $paydata['client_secret'];
        $paypal_conf['settings']['mode'] = $paydata['sandbox_check'] == 1 ? 'sandbox' : 'live';
        $this->_api_context = new ApiContext(
            new OAuthTokenCredential(
                $paypal_conf['client_id'],
                $paypal_conf['secret']
            )
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function store(Request $request)
    {

        if (!Session::has('cart')) {
            return view('errors.404');
        }

        $total = $this->orderTotal($request->shipping_charge);


        $request->validate([
            'billing_fname' => 'required',
            'billing_lname' => 'required',
            'billing_address' => 'required',
            'billing_city' => 'required',
            'billing_country' => 'required',
            'billing_number' => 'required',
            'billing_email' => 'required',
            'shpping_fname' => 'required',
            'shpping_lname' => 'required',
            'shpping_address' => 'required',
            'shpping_city' => 'required',
            'shpping_country' => 'required',
            'shpping_number' => 'required',
            'shpping_email' => 'required',
        ]);

        $input = $request->all();
        // Validation Starts
        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }

        $be = $currentLang->basic_extended;

        $title = 'Product Checkout';

        $order['order_number'] = Str::random(4) . time();

        $order['order_amount'] = round($total, 2);
        $cancel_url = action('Payment\product\PaymentController@paycancle');
        $notify_url = route('product.payment.notify');
        $success_url = action('Payment\product\PaymentController@payreturn');

        $total = round(($total / $be->base_currency_rate), 2);

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName($title)
            /** item name **/
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice(round($total, 2));
        /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal(round($total, 2));
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription($title . ' Via Paypal');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl($notify_url)
            /** Specify return URL **/
            ->setCancelUrl($cancel_url);
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_data', $input);
        Session::put('order_data', $order);
        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        return redirect()->back()->with('error', 'Unknown error occurred');

        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        return redirect()->back()->with('error', 'Unknown error occurred');
    }




    public function notify(Request $request)
    {

        // Validation Starts
        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }

        $be = $currentLang->basic_extended;


        $paypal_data = Session::get('paypal_data');


        $order_data = Session::get('order_data');
        $success_url = action('Payment\product\PaymentController@payreturn');
        $cancel_url = action('Payment\product\PaymentController@paycancle');
        $input = $request->all();
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        /** clear the session payment ID **/
        if (empty($input['PayerID']) || empty($input['token'])) {
            return redirect($cancel_url);
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($input['PayerID']);
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {
            $resp = json_decode($payment, true);

            $shipping_method = '';
            if ($paypal_data['shipping_charge'] != 0) {
                $shipping = ShippingCharge::findOrFail($paypal_data['shipping_charge']);
                $shippig_charge = $shipping->charge;
                $shipping_method = $shipping->title;
            } else {
                $shippig_charge = 0;
            }


            $order = new ProductOrder;


            $order->billing_fname = $paypal_data['billing_fname'];
            $order->billing_lname = $paypal_data['billing_lname'];
            $order->billing_email = $paypal_data['billing_email'];
            $order->billing_address = $paypal_data['billing_address'];
            $order->billing_city = $paypal_data['billing_city'];
            $order->billing_country = $paypal_data['billing_country'];
            $order->billing_number = $paypal_data['billing_number'];
            $order->shpping_fname = $paypal_data['shpping_fname'];
            $order->shpping_lname = $paypal_data['shpping_lname'];
            $order->shpping_email = $paypal_data['shpping_email'];
            $order->shpping_address = $paypal_data['shpping_address'];
            $order->shpping_city = $paypal_data['shpping_city'];
            $order->shpping_country = $paypal_data['shpping_country'];
            $order->shpping_number = $paypal_data['shpping_number'];
            $order->order_notes = $paypal_data['order_notes'];


            $order->total = round($order_data['order_amount'], 2);
            $order->shipping_method = $shipping_method;
            $order->shipping_charge = round($shippig_charge, 2);
            $order->method = $paypal_data['method'];
            $order->currency_code = $be->base_currency_text;
            $order->currency_code_position = $be->base_currency_text_position;
            $order->currency_symbol = $be->base_currency_symbol;
            $order->currency_symbol_position = $be->base_currency_symbol_position;

            $order['order_number'] = $order_data['order_number'];
            $order['payment_status'] = "Completed";
            $order['txnid'] = $resp['transactions'][0]['related_resources'][0]['sale']['id'];
            $order['charge_id'] = $request->paymentId;
            $order['user_id'] = Auth::user()->id;
            $order['method'] = 'Paypal';

            $order->save();
            $order_id = $order->id;

            // save ordered items
            $this->saveOrderItem($order_id);


            // send mail to buyer
            $this->mailFromAdmin($order);


            // send mail to admin
            $this->mailToAdmin($order);


            Session::forget('paypal_data');
            Session::forget('order_data');
            Session::forget('paypal_payment_id');
            Session::forget('cart');

            event(new OrderPlaced());

            return redirect($success_url);
        }
        return redirect($cancel_url);
    }
}
