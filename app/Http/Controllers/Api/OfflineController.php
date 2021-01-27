<?php

namespace App\Http\Controllers\Api;

use App\Events\OrderPlaced;
use App\Http\Controllers\Api\PaymentController;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\OfflineGateway;
use App\Models\ProductOrder;
use App\Models\ShippingCharge;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Str;
use App\Models\User;
use App\Models\CartItem;
use App\Models\OrderItem;


class OfflineController extends PaymentController
{
    public function totalPrice(Request $request){
        if ($request->shipping_charge != 0) {
            $shipping = ShippingCharge::findOrFail($request->shipping_charge);
            $shippig_charge = $shipping->charge;
        } else {
            $shippig_charge = 0;
        }
        
        $total = $this->orderTotal($request->shipping_charge);

        return response()->json($total);
    }
    public function store(Request $request, $product_id) {

        $received_data = json_decode(file_get_contents("php://input"));
        // dd($received_data );

        if ($request->shipping_charge != 0) {
            $shipping = ShippingCharge::findOrFail($request->shipping_charge);
            $shippig_charge = $shipping->charge;
        } else {
            $shippig_charge = 0;
        }

        $total = $this->orderTotal($request->shipping_charge);

        
        // Validation Starts
        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }

        $be = $currentLang->basic_extended;

        $success_url = action('Payment\product\PaymentController@payreturn');

        $rules = [
            'form.billing_fname' => 'required',
            'form.billing_lname' => 'required',
            // 'billing_address' => 'required',
            // 'billing_city' => 'required',
            // 'billing_country' => 'required',
            'form.billing_number' => 'required',
            'form.billing_email' => 'required',
            // 'shpping_fname' => 'required',
            // 'shpping_lname' => 'required',
            // 'shpping_address' => 'required',
            // 'shpping_city' => 'required',
            // 'shpping_country' => 'required',
            // 'shpping_number' => 'required',
            // 'shpping_email' => 'required'
        ];

        // $gateway = OfflineGateway::find();

            // $rules['receipt'] = [
            //     'required',
            //     function ($attribute, $value, $fail) use ($request) {
            //         $ext = $request->file('receipt')->getClientOriginalExtension();
            //         if (!in_array($ext, array('jpg', 'png', 'jpeg'))) {
            //             return $fail("Only png, jpg, jpeg image is allowed");
            //         }
            //     },
            // ];
        

        $request->validate($rules);

        $order = new ProductOrder();
        $order->user_id = 1;
        $order->billing_fname = $received_data->form->billing_fname;
        $order->billing_lname = $received_data->form->billing_lname;
        $order->billing_email = $received_data->form->billing_email;
        // $order->billing_address = $request->billing_address;
        // $order->billing_city = $request->billing_city;
        // $order->billing_country = $request->billing_country;
        $order->billing_number = $received_data->form->billing_number;
        // $order->shpping_fname = $request->shpping_fname;
        // $order->shpping_lname = $request->shpping_lname;
        // $order->shpping_email = $request->shpping_email;
        // $order->shpping_address = $request->shpping_address;
        // $order->shpping_city = $request->shpping_city;
        // $order->shpping_country = $request->shpping_country;
        // $order->shpping_number = $request->shpping_number;
        $order->order_notes = $received_data->form->order_notes;

        $order->total = $total;
        $order->shipping_charge = round($shippig_charge, 2);
        $order->method = 'Pay By Cash';
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
                        if($received_data->AddOnTotal){
                        $orderItem->addons_price = (float)$received_data->AddOnTotal;
                        }
                        $orderItem->image = $cart->feature_image ?? '';
                        $orderItem->variations_price = (float)$received_data->variationTotal ?? '';
                        $orderItem->save();
                        CartItem::where('cart_key', $cart_key['cart_key'])->delete();
                }
                $order_id = $order->id;
                $user = new User();
                $user->fname = $received_data->form->billing_fname;
                $user->lname = $received_data->form->billing_lname;
                $user->username = $received_data->form->billing_fname . ' ' . $received_data->form->billing_lname;
                $user->email = $received_data->form->billing_email;
                $user->billing_email = $received_data->form->billing_email;
                $user->billing_number = $received_data->form->billing_number;
                $user->save();

                return response()->json(["status_code"=>"AB", "message"=>"Order Saved Successfully"]);
            }
        } else {
        return response()->json(["status_code"=>"AC", "message"=>"Your cart is empty"]);
        }


        
        
            // save ordered items
        // $this->saveOrderItem($order_id);

        // send mail to buyer
        $this->mailFromAdmin($order);

        // send mail to admin
        $this->mailToAdmin($order);

        Session::forget('cart');

        event(new OrderPlaced());

        return redirect($success_url);
    }
}
