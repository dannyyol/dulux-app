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
// use App\Models\OfflineGateway;


class OfflineController extends PaymentController
{
    public function paymentMethod($request,$order, $pickNow, $pickLater, $someone, $deliverToYou){

        if($request->pickNow == 'pickNow'){
            $request->validate($pickNow, OfflineGateway::messages());
            return "Pick Now";
        }
        elseif($request->pickLater == "pickLater"){
            $request->validate($pickLater, OfflineGateway::messages());
            // date to pick
            $order->date_to_pick = substr( $request->date, 0, strpos($request->date, "T")) ?? null;
            return "Pick Later";
        }
        elseif($request->someone == "someone"){
            $request->validate($someone, OfflineGateway::messages());
            // date to pick someone
            $order->someone_fname = $request->someone_fname ?? null;
            $order->someone_lname =$request->someone_lname ?? null;
            $order->someone_number = $request->someone_number ?? null;
            return "For Someone";
        }

        elseif($request->deliverToYou == "deliverToYou"){
            $request->validate($deliverToYou, OfflineGateway::messages());
            // Deliver to you
            $order->shpping_fname = $request->shpping_fname;
            $order->shpping_lname = $request->shpping_lname;
            $order->shpping_email = $request->shpping_email;
            $order->shpping_address = $request->shpping_address;
            $order->shpping_city = $request->shpping_city;
            $order->shpping_country = $request->shpping_country;
            $order->shpping_number = $request->shpping_number;
            return "Deliver To You";
        }

    }
    // public function saveByMethod($request,$order, $pickNow, $pickLater, $someone, $deliverToYou){

    // }
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
        // $request = json_decode(file_get_contents("php://input"));
        // dd($request->all());
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

        $pickNow = [
            'fname' => 'required',
            'lname' => 'required',
            'number' => 'required',
            'email' => 'required',
        ];

        $pickLater = [
            'fname' => 'required',
            'lname' => 'required',
            'number' => 'required',
            'email' => 'required',
            'date'=>'required'
        ];

        $someone = [
            'fname' => 'required',
            'lname' => 'required',
            'number' => 'required',
            'email' => 'required',
            'date'=>'required',
            'someone_fname' => 'required',
            'someone_lname' => 'required',
            'someone_number' => 'required'
        ];

        $deliverToYou =[

            'fname' => 'required',
            'lname' => 'required',
            'number' => 'required',
            'email' => 'required',
            'shpping_fname' => 'required',
            'shpping_lname' => 'required',
            'shpping_address' => 'required',
            'shpping_city' => 'required',
            'shpping_country' => 'required',
            'shpping_number' => 'required',
            'shpping_email' => 'required',
        ];


        $order = new ProductOrder();
        $order->user_id = 1;
        
        $method = $this->paymentMethod($request, $order, $pickNow, $pickLater, $someone, $deliverToYou);
        $order->billing_fname = $request->fname;
        $order->billing_lname = $request->lname;
        $order->billing_email = $request->email;
        $order->billing_number = $request->number;
        $order->order_notes = $request->order_notes;

        $order->total = $request->cartTotal;
        $order->shipping_charge = round($shippig_charge, 2);
        $order->method = $method;
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
        if($carts && !empty($request->cartTotal)){

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
                        $orderItem->total = $request->cartTotal;
                        if($request->AddOnTotal){
                            $orderItem->addons_price = (float)$request->AddOnTotal;
                        }
                        $orderItem->image = $cart->feature_image ?? '';
                        $orderItem->variations_price = (float)$request->variationTotal ?? '';
                        $orderItem->save();
                        CartItem::where('cart_key', $cart_key['cart_key'])->delete();
                }
                $order_id = $order->id;
                $user = new User();
                $user->fname = $request->fname;
                $user->lname = $request->lname;
                $user->username = $request->fname . ' ' . $request->lname;
                $user->email = $request->email;
                $user->billing_email = $request->email;
                $user->billing_number = $request->number;
                $user->save();
                

                return response()->json(["status_code"=>"AB", "message"=>"Order Saved Successfully", 'data'=>rand(1000,9000)]);
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
