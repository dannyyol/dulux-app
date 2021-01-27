<?php

namespace App\Http\Controllers\Api;

use App\Events\OrderPlaced;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Helpers\MegaMailer;
use App\Models\Language;
use Illuminate\Support\Str;
use App\Models\ProductOrder;
use App\Models\CartItem;
use App\Models\OrderItem;

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
use App\Models\User;


class PaybydeliveryController extends PaymentController
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

        // if (!Session::has('cart')) {
        //     return view('errors.404');
        // }
        $received_data = json_decode(file_get_contents("php://input"));

        // dd($request);

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
        $total = round(($total / $be->base_currency_rate), 2);

        $order = new ProductOrder();
        $order->user_id = 1;
        $order->billing_fname = $received_data->form->billing_fname;
        $order->billing_lname = $received_data->form->billing_lname;
        $order->billing_email = $received_data->form->billing_email;
        $order->billing_address = $received_data->form->billing_address;
        $order->billing_city = $received_data->form->billing_city;
        $order->billing_country = $received_data->form->billing_country;
        $order->billing_number = $received_data->form->billing_number;
        $order->shpping_fname = $received_data->form->shpping_fname;
        $order->shpping_lname = $received_data->form->shpping_lname;
        $order->shpping_email = $received_data->form->shpping_email;
        $order->shpping_address = $received_data->form->shpping_address;
        $order->shpping_city = $received_data->form->shpping_city;
        $order->shpping_country = $received_data->form->shpping_country;
        $order->shpping_number = $received_data->form->shpping_number;
        $order->order_notes = $received_data->form->order_notes ?? '';

        $order->total = $total;
        $order->shipping_charge = 1.0; // round($shippig_charge, 2);
        $order->method = 'Pay By Delivery';
        $order->currency_code = $be->base_currency_text;
        $order->currency_code_position = $be->base_currency_text_position;
        $order->currency_symbol = $be->base_currency_symbol;
        $order->currency_symbol_position = $be->base_currency_symbol_position;
        $order->order_number = Str::random(4) . time();
        $order->payment_status = 'Completed';
        $order['txnid'] = 'txn_' . Str::random(8) . time();
        $order['charge_id'] = 'ch_' . Str::random(9) . time();
        if ($request->hasFile('receipt')) {
            $receipt = uniqid() . '.' . $request->file('receipt')->getClientOriginalExtension();
            $request->file('receipt')->move('assets/front/receipt/', $receipt);
            $order['receipt'] = $receipt;
        }

        $cart_key = Session::get('cart_key');
        $carts = CartItem::where(['cart_key'=>$cart_key['cart_key']])->get();
        if($carts && !empty($received_data->cartTotal)){
            if($order->save()){
                $order_id = $order->id;
                foreach($carts as $cart){
                    $orderItem = new OrderItem;
                    $orderItem->product_id=$cart->product_id;
                    $orderItem->product_order_id = $order->id;
                    $orderItem->title = $cart->product_name;
                    $orderItem->qty = $cart->product_quantity;
                    $orderItem->variations = $cart->variations;
                    $orderItem->addons = $cart->addons;
                    $orderItem->product_price = $cart->product_price;
                    $orderItem->total = $received_data->cartTotal;
                    $orderItem->save();
                }

            $user = new User();
            $user->fname = $received_data->form->billing_fname;
            $user->lname = $received_data->form->billing_lname;
            $user->username = $received_data->form->billing_fname . ' ' . $received_data->form->billing_lname;
            $user->email = $received_data->form->billing_email;
            $user->billing_email = $received_data->form->billing_email;
            $user->billing_number = $received_data->form->billing_number;

            $user->billing_city = $received_data->form->billing_city;
            $user->billing_country = $received_data->form->billing_country;
            $user->billing_number = $received_data->form->billing_number;
            $user->shpping_fname = $received_data->form->shpping_fname;
            $user->shpping_lname = $received_data->form->shpping_lname;
            $user->shpping_email = $received_data->form->shpping_email;
            $user->shpping_address = $received_data->form->shpping_address;
            $user->shpping_city = $received_data->form->shpping_city;
            $user->shpping_country = $received_data->form->shpping_country;
            $user->shpping_number = $received_data->form->shpping_number;
            $user->save();
            $cart_key = Session::get('cart_key');
            CartItem::where('cart_key', $cart_key['cart_key'])->delete();

                return response()->json(["status_code"=>"AB", "message"=>"Order Saved Successfully"]);
            }

        } else {
        return response()->json(["status_code"=>"AC", "message"=>"Your cart is empty"]);
        }

        



        // $payer = new Payer();
        // $payer->setPaymentMethod('paypal');
        // $item_1 = new Item();
        // $item_1->setName($title)
            /** item name **/
            // ->setCurrency('USD')
            // ->setQuantity(1)
            // ->setPrice(round($total, 2));
        /** unit price **/
        // $item_list = new ItemList();
        // $item_list->setItems(array($item_1));
        // $amount = new Amount();
        // $amount->setCurrency('USD')
        //     ->setTotal(round($total, 2));
        // $transaction = new Transaction();
        // $transaction->setAmount($amount)
        //     ->setItemList($item_list)
        //     ->setDescription($title . ' Via Paypal');
        // $redirect_urls = new RedirectUrls();
        // $redirect_urls->setReturnUrl($notify_url)
            /** Specify return URL **/
        //     ->setCancelUrl($cancel_url);
        // $payment = new Payment();
        // $payment->setIntent('Sale')
        //     ->setPayer($payer)
        //     ->setRedirectUrls($redirect_urls)
        //     ->setTransactions(array($transaction));

        // try {
        //     $payment->create($this->_api_context);
        // } catch (\PayPal\Exception\PPConnectionException $ex) {
        //     return redirect()->back()->with('error', $ex->getMessage());
        // }
        // foreach ($payment->getLinks() as $link) {
        //     if ($link->getRel() == 'approval_url') {
        //         $redirect_url = $link->getHref();
        //         break;
        //     }
        // }
        /** add payment ID to session **/
        // Session::put('paypal_data', $input);
        // Session::put('order_data', $order);
        // Session::put('paypal_payment_id', $payment->getId());
        // if (isset($redirect_url)) {
        //     /** redirect to paypal **/
        //     return Redirect::away($redirect_url);
        // }
        // return redirect()->back()->with('error', 'Unknown error occurred');

        // if (isset($redirect_url)) {
        //     /** redirect to paypal **/
        //     return Redirect::away($redirect_url);
        // }
        // return redirect()->back()->with('error', 'Unknown error occurred');
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
