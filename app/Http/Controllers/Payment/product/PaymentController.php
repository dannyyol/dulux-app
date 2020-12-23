<?php

namespace App\Http\Controllers\Payment\product;

use App\Http\Controllers\Controller;
use App\Http\Helpers\MegaMailer;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\OrderItem;
use App\Models\ProductOrder;
use Carbon\Carbon;
use Session;
use Auth;
use PDF;
use Str;
use App\Models\ShippingCharge;

class PaymentController extends Controller
{
    public function paycancle()
    {
        return redirect()->route('front.checkout')->with('error', 'Payment Cancelled.');
    }

    public function payreturn()
    {
        return view('front.product.success');
    }

    public function orderTotal($scharge) {
        $cart = Session::get('cart');
        $total = 0.00;

        foreach ($cart as $key => $cartItem) {

            $total += $cartItem["total"];
        }

        if ($scharge != 0) {
            $shipping = ShippingCharge::findOrFail($scharge);
            $shippig_charge = $shipping->charge;
        } else {
            $shippig_charge = 0;
        }
        $total = round($total + $shippig_charge, 2);

        return $total;
    }

    public function saveOrderItem($orderId) {
        $cart = Session::get('cart');

        foreach ($cart as $key => $cartItem) {

            $addonTotal = 0.00;
            if (!empty($cartItem["addons"])) {
                foreach ($cartItem["addons"] as $key => $addon) {
                    $addonTotal += (float)$addon["price"];
                }
                $addonTotal = $addonTotal * (int)$cartItem["qty"];
            }
            $vprice = !empty($cartItem["variations"]) ? (float)$cartItem["variations"]["price"] * (int)$cartItem["qty"] : 0.00;
            $pprice = (float)$cartItem["product_price"] * (int)$cartItem["qty"];

            OrderItem::insert([
                'product_order_id' => $orderId,
                'product_id' => $cartItem["id"],
                'user_id' => Auth::user()->id,
                'title' => $cartItem["name"],
                'variations' => json_encode($cartItem["variations"]),
                'addons' => json_encode($cartItem["addons"]),
                'variations_price' => $vprice,
                'addons_price' => $addonTotal,
                'product_price' => $pprice,
                'total' => $pprice + $vprice + $addonTotal,
                'qty' => $cartItem["qty"],
                'image' => $cartItem["photo"],
                'created_at' => Carbon::now()
            ]);
        }
    }


    public function mailFromAdmin($order) {
        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }

        $bs = $currentLang->basic_setting;

        $fileName = Str::random(4) . time() . '.pdf';
        $path = 'assets/front/invoices/product/' . $fileName;
        $data['order']  = $order;
        PDF::loadView('pdf.product', $data)->save($path);


        ProductOrder::where('id', $order->id)->update([
            'invoice_number' => $fileName
        ]);

        // Send Mail to Buyer
        $user = Auth::user();

        $mailer = new MegaMailer();
        $data = [
            'toMail' => $user->email,
            'toName' => $user->fname,
            'attachment' => $fileName,
            'customer_name' => $user->fname,
            'order_number' => $order->order_number,
            'order_link' => "<a href='" . route('user-orders-details',$order->id) . "'>" . route('user-orders-details',$order->id) . "</a>",
            'website_title' => $bs->website_title,
            'templateType' => 'food_checkout',
            'type' => 'foodCheckout'
        ];
        $mailer->mailFromAdmin($data);
    }

    public function mailToAdmin($order) {
        $subject = 'New Order Placed';
        $body = "A new order has been placed.<br>
        <strong>Order Number: </strong> " . $order->order_number . "<br>
        <a href='" . route('admin.product.details', $order->id) . "'>Click here to view order details</a>";
        $data = [
            'fromMail' => $order->billing_email,
            'fromName' => $order->billing_fname,
            'subject' => $subject,
            'body' => $body
        ];
        $mailer = new MegaMailer();
        $mailer->mailToAdmin($data);
    }
}
