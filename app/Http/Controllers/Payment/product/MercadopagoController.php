<?php

namespace App\Http\Controllers\Payment\product;

use App\Events\OrderPlaced;
use App\Http\Controllers\Payment\product\PaymentController;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\PaymentGateway;
use App\Models\ProductOrder;
use App\Models\ShippingCharge;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Str;

class MercadopagoController extends PaymentController
{
    private $access_token;
    private $sandbox;

    public function __construct()
    {
        $data = PaymentGateway::whereKeyword('mercadopago')->first();
        $paydata = $data->convertAutoData();
        $this->access_token = $paydata['token'];
        $this->sandbox = $paydata['sandbox_check'];
    }

    public function store(Request $request)
    {
        // Validation Starts
        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }

        $be = $currentLang->basic_extended;
        $bs = $currentLang->basic_setting;

        $available_currency = array('ARS','BOB','BRL','CLF','CLP','COP','CRC','CUC','CUP','DOP','EUR','GTQ','HNL','MXN','NIO','PAB','PEN','PYG','UYU','VEF','VES');
        if (!in_array($be->base_currency_text, $available_currency)) {
            return redirect()->back()->with('error', 'Invalid Currency For Mercado Pago.');
        }

        if ($request->shipping_charge != 0) {
            $shipping = ShippingCharge::findOrFail($request->shipping_charge);
            $shippig_charge = $shipping->charge;
        } else {
            $shippig_charge = 0;
        }

        $total = $this->orderTotal($request->shipping_charge);


        $rules = [
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
            'shpping_email' => 'required'
        ];

        $request->validate($rules);


        $order = new ProductOrder();
        $order->user_id = Auth::user()->id;
        $order->billing_fname = $request->billing_fname;
        $order->billing_lname = $request->billing_lname;
        $order->billing_email = $request->billing_email;
        $order->billing_address = $request->billing_address;
        $order->billing_city = $request->billing_city;
        $order->billing_country = $request->billing_country;
        $order->billing_number = $request->billing_number;
        $order->shpping_fname = $request->shpping_fname;
        $order->shpping_lname = $request->shpping_lname;
        $order->shpping_email = $request->shpping_email;
        $order->shpping_address = $request->shpping_address;
        $order->shpping_city = $request->shpping_city;
        $order->shpping_country = $request->shpping_country;
        $order->shpping_number = $request->shpping_number;
        $order->order_notes = $request->order_notes;

        $order->total = $total;
        $order->shipping_charge = round($shippig_charge, 2);
        $order->method = "Mercado Pago";
        $order->currency_code = $be->base_currency_text;
        $order->currency_code_position = $be->base_currency_text_position;
        $order->currency_symbol = $be->base_currency_symbol;
        $order->currency_symbol_position = $be->base_currency_symbol_position;
        $order->order_number = Str::random(4) . time();
        $order->payment_status = 'Pending';
        $order['txnid'] = 'txn_' . Str::random(8) . time();
        $order['charge_id'] = 'ch_' . Str::random(9) . time();


        $order->save();
        $order_id = $order->id;

        // save ordered items
        $this->saveOrderItem($order_id);


        $return_url = route('product.payment.return');
        $cancel_url = route('product.payment.cancle');
        $notify_url = route('product.mercadopago.notify');

        $item_name = $bs->website_title . " Order";
        $item_number = Str::random(4) . time();
        $item_amount = (float) $total;


        $curl = curl_init();


        $preferenceData = [
            'items' => [
                [
                    'id' => $item_number,
                    'title' => $item_name,
                    'description' => $item_name,
                    'quantity' => 1,
                    'currency_id' => $be->base_currency_text,
                    'unit_price' => $item_amount
                ]
            ],
            'payer' => [
                'email' => $request->billing_email,
            ],
            'back_urls' => [
                'success' => $return_url,
                'pending' => '',
                'failure' => $cancel_url,
            ],
            'notification_url' =>  $notify_url,
            'auto_return' =>  'approved',

        ];

        $httpHeader = [
            "Content-Type: application/json",
        ];
        $url = "https://api.mercadopago.com/checkout/preferences?access_token=" . $this->access_token;
        $opts = [
            CURLOPT_URL             => $url,
            CURLOPT_CUSTOMREQUEST   => "POST",
            CURLOPT_POSTFIELDS      => json_encode($preferenceData, true),
            CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_TIMEOUT         => 30,
            CURLOPT_HTTPHEADER      => $httpHeader
        ];

        curl_setopt_array($curl, $opts);

        $response = curl_exec($curl);
        $payment = json_decode($response,true);

        $err = curl_error($curl);

        curl_close($curl);

        $orderData['order_id'] = $order_id;

        Session::put('order_data', $orderData);

        if($this->sandbox == 1)
        {
            return redirect($payment['sandbox_init_point']);
        }
        else {
            return redirect($payment['init_point']);
        }
    }

    public function curlCalls($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $paymentData = curl_exec($ch);
        curl_close($ch);
        return $paymentData;
    }

    public function paycancle()
    {
        return redirect()->back()->with('error', 'Payment Cancelled.');
    }

    public function payreturn()
    {
        if (Session::has('tempcart')) {
            $oldCart = Session::get('tempcart');
            $tempcart = new Cart($oldCart);
            $order = Session::get('temporder');
        } else {
            $tempcart = '';
            return redirect()->back();
        }

        return view('front.success', compact('tempcart', 'order'));
    }

    public function notify(Request $request)
    {

        $order_data = Session::get('order_data');
        // dd($order_data);
        $success_url = route('product.payment.return');
        $cancel_url = route('product.payment.cancle');

        $paymentUrl = "https://api.mercadopago.com/v1/payments/" . $request['data']['id'] . "?access_token=" . $this->access_token;

        $paymentData = $this->curlCalls($paymentUrl);

        $payment = json_decode($paymentData, true);



        if ($payment['status'] == 'approved') {
            $po = ProductOrder::findOrFail($order_data["order_id"]);
            $po->payment_status = "Completed";
            $po->save();

            // send mail to buyer
            $this->mailFromAdmin($po);

            // send mail to admin
            $this->mailToAdmin($po);

            Session::forget('order_data');
            Session::forget('cart');

            event(new OrderPlaced());

            return redirect($success_url);
        }

        return redirect($cancel_url);
    }
}
