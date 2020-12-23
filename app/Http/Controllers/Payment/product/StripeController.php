<?php

namespace App\Http\Controllers\Payment\product;

use App\Events\OrderPlaced;
use Illuminate\Http\Request;
use App\Http\Controllers\Payment\product\PaymentController;
use Config;
use Illuminate\Support\Str;
use PHPMailer\PHPMailer\Exception;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use App\Models\PaymentGateway;
use App\Models\Language;
use App\Models\ProductOrder;
use App\Models\ShippingCharge;
use Auth;
use Session;

class StripeController extends PaymentController
{
    public function __construct()
    {
        //Set Spripe Keys
        $stripe = PaymentGateway::findOrFail(14);
        $stripeConf = json_decode($stripe->information, true);
        Config::set('services.stripe.key', $stripeConf["key"]);
        Config::set('services.stripe.secret', $stripeConf["secret"]);
    }


    public function store(Request $request)
    {
        if (!Session::has('cart')) {
            return view('errors.404');
        }

        $shipping_method = '';
        if ($request->shipping_charge != 0) {
            $shipping = ShippingCharge::findOrFail($request->shipping_charge);
            $shippig_charge = $shipping->charge;
            $shipping_method = $shipping->title;
        } else {
            $shippig_charge = 0;
        }


        // Validation Starts
        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }

        $be = $currentLang->basic_extended;


        $total = $this->orderTotal($request->shipping_charge);
        $usdTotal = round(($total / $be->base_currency_rate), 2);

        $title = 'Product Checkout';
        $success_url = action('Payment\product\PaymentController@payreturn');

        $request->validate([
            'cardNumber' => 'required',
            'cardCVC' => 'required',
            'month' => 'required',
            'year' => 'required',
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


        $stripe = Stripe::make(Config::get('services.stripe.secret'));
        try {

            $token = $stripe->tokens()->create([
                'card' => [
                    'number' => $request->cardNumber,
                    'exp_month' => $request->month,
                    'exp_year' => $request->year,
                    'cvc' => $request->cardCVC,
                ],
            ]);

            if (!isset($token['id'])) {
                return back()->with('error', 'Token Problem With Your Token.');
            }

            $charge = $stripe->charges()->create([
                'card' => $token['id'],
                'currency' =>  'USD',
                'amount' => $usdTotal,
                'description' => $title,
            ]);



            if ($charge['status'] == 'succeeded') {

                $order = new ProductOrder;
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
                $order->shipping_method = $shipping_method;
                $order->shipping_charge = round($shippig_charge, 2);
                $order->method = 'Stripe';
                $order->currency_code = $be->base_currency_text;
                $order->currency_code_position = $be->base_currency_text_position;
                $order->currency_symbol = $be->base_currency_symbol;
                $order->currency_symbol_position = $be->base_currency_symbol_position;
                $order->order_number = Str::random(4) . time();
                $order->payment_status = 'Completed';
                $order['txnid'] = $charge['balance_transaction'];
                $order['charge_id'] = $charge['id'];




                $order->save();
                $order_id = $order->id;

                // save ordered items
                $this->saveOrderItem($order_id);

                // send mail to buyer
                $this->mailFromAdmin($order);
                // send mail to admin
                $this->mailToAdmin($order);

                Session::forget('cart');

                event(new OrderPlaced());

                return redirect($success_url);
            }
        } catch (Exception $e) {
            return back()->with('unsuccess', $e->getMessage());
        } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
            return back()->with('unsuccess', $e->getMessage());
        } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
            return back()->with('unsuccess', $e->getMessage());
        }

        // return back()->with('unsuccess', 'Please Enter Valid Credit Card Informations.');
    }
}
