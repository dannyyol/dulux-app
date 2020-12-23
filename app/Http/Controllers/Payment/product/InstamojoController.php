<?php

namespace App\Http\Controllers\Payment\product;

use App\Events\OrderPlaced;
use App\Http\Controllers\Payment\product\PaymentController;
use Illuminate\Http\Request;
use App\Http\Helpers\Instamojo;
use App\Models\Language;
use App\Models\PaymentGateway;
use App\Models\ProductOrder;
use App\Models\ShippingCharge;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PHPMailer\PHPMailer\Exception;
use Str;

class InstamojoController extends PaymentController
{
    public function store(Request $request)
    {
        if (!Session::has('cart')) {
            return view('errors.404');
        }

        if ($request->shipping_charge != 0) {
            $shipping = ShippingCharge::findOrFail($request->shipping_charge);
            $shippig_charge = $shipping->charge;
        } else {
            $shippig_charge = 0;
        }

        $total = $this->orderTotal($request->shipping_charge);

        $data = PaymentGateway::whereKeyword('instamojo')->first();
        $paydata = $data->convertAutoData();

        // Validation Starts

        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }

        $be = $currentLang->basic_extended;
        $bs = $currentLang->basic_setting;


        if ($be->base_currency_text != "INR") {
            return redirect()->back()->with('error', __('Please Select INR Currency For This Payment.'));
        } elseif ($total < 9) {
            return redirect()->back()->with('error', __('Amount cannot be less than INR 9.00'));
        }

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
        // Validation Ends



        // saving datas in database
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
        $order->method = "Instamojo";
        $order->currency_code = $be->base_currency_text;
        $order->currency_code_position = $be->base_currency_text_position;
        $order->currency_symbol = $be->base_currency_symbol;
        $order->currency_symbol_position = $be->base_currency_symbol_position;
        $order->order_number = Str::random(4) . time();
        $order->payment_status = 'Pending';
        $order['txnid'] = 'txn_' . Str::random(8) . time();
        $order['charge_id'] = 'ch_' . Str::random(9) . time();
        if ($request->hasFile('receipt')) {
            $receipt = uniqid() . '.' . $request->file('receipt')->getClientOriginalExtension();
            $request->file('receipt')->move('assets/front/receipt/', $receipt);
            $order['receipt'] = $receipt;
        }


        $order->save();
        $order_id = $order->id;

        // save ordered items
        $this->saveOrderItem($order_id);
        // saving datas in database


        $orderData['item_name'] = $bs->website_title . " Order";
        $orderData['item_number'] = Str::random(4) . time();
        $orderData['item_amount'] = $total;
        $orderData['order_id'] = $order_id;

        $cancel_url = route('product.payment.cancle');
        $notify_url = route('product.instamojo.notify');


        if ($paydata['sandbox_check'] == 1) {
            $api = new Instamojo($paydata['key'], $paydata['token'], 'https://test.instamojo.com/api/1.1/');
        } else {
            $api = new Instamojo($paydata['key'], $paydata['token']);
        }

        try {

            $response = $api->paymentRequestCreate(array(
                "purpose" => $orderData['item_name'],
                "amount" => $orderData['item_amount'],
                "send_email" => false,
                "email" =>  null,
                "redirect_url" => $notify_url
            ));



            $redirect_url = $response['longurl'];

            Session::put('order_payment_id', $response['id']);
            Session::put('order_data', $orderData);

            return redirect($redirect_url);
        } catch (Exception $e) {

            return redirect($cancel_url)->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function notify(Request $request)
    {

        $order_data = Session::get('order_data');
        $orderid = $order_data["order_id"];
        $success_url = route('product.payment.return');
        $cancel_url = route('product.payment.cancle');
        $input_data = $request->all();
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('order_payment_id');

        if ($input_data['payment_request_id'] == $payment_id) {
            $po = ProductOrder::findOrFail($orderid);
            $po->payment_status = "Completed";
            $po->save();

            // send mail to buyer
            $this->mailFromAdmin($po);

            // send mail to admin
            $this->mailToAdmin($po);

            Session::forget('order_payment_id');
            Session::forget('order_data');
            Session::forget('cart');

            event(new OrderPlaced());

            return redirect($success_url);
        }
        return redirect($cancel_url);
    }
}
