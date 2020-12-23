<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\MegaMailer;
use App\Models\ProductOrder;
use App\Models\BasicExtended;
use App\Models\BasicSetting;
use App\Models\User;
use Session;

class ProductOrderController extends Controller
{
    public function all(Request $request)
    {
        $search = $request->search;
        $data['orders'] =
        ProductOrder::when($search, function ($query, $search) {
            return $query->where('order_number', $search);
        })
        ->orderBy('id', 'DESC')->paginate(10);

        return view('admin.product.order.index', $data);
    }

    public function pending(Request $request)
    {
        $search = $request->search;
        $data['orders'] = ProductOrder::
        when($search, function ($query, $search) {
            return $query->where('order_number', $search);
        })
        ->where('order_status', 'pending')->orderBy('id', 'DESC')->paginate(10);
        return view('admin.product.order.index', $data);
    }

    public function received(Request $request)
    {
        $search = $request->search;
        $data['orders'] = ProductOrder::where('order_status', 'received')
        ->when($search, function ($query, $search) {
            return $query->where('order_number', $search);
        })
        ->orderBy('id', 'DESC')->paginate(10);
        return view('admin.product.order.index', $data);
    }

    public function preparing(Request $request)
    {
        $search = $request->search;
        $data['orders'] = ProductOrder::where('order_status', 'preparing')->
        when($search, function ($query, $search) {
            return $query->where('order_number', $search);
        })
        ->orderBy('id', 'DESC')->paginate(10);
        return view('admin.product.order.index', $data);
    }

    public function readyToPickup(Request $request)
    {
        $search = $request->search;
        $data['orders'] = ProductOrder::where('order_status', 'ready_to_pick_up')->
        when($search, function ($query, $search) {
            return $query->where('order_number', $search);
        })
        ->orderBy('id', 'DESC')->paginate(10);
        return view('admin.product.order.index', $data);
    }

    public function pickedUp(Request $request)
    {
        $search = $request->search;
        $data['orders'] = ProductOrder::where('order_status', 'picked_up')->
        when($search, function ($query, $search) {
            return $query->where('order_number', $search);
        })
        ->orderBy('id', 'DESC')->paginate(10);
        return view('admin.product.order.index', $data);
    }

    public function delivered(Request $request)
    {
        $search = $request->search;
        $data['orders'] = ProductOrder::where('order_status', 'delivered')->
        when($search, function ($query, $search) {
            return $query->where('order_number', $search);
        })
        ->orderBy('id', 'DESC')->paginate(10);
        return view('admin.product.order.index', $data);
    }

    public function cancelled(Request $request)
    {
        $search = $request->search;
        $data['orders'] = ProductOrder::where('order_status', 'cancelled')->
        when($search, function ($query, $search) {
            return $query->where('order_number', $search);
        })
        ->orderBy('id', 'DESC')->paginate(10);
        return view('admin.product.order.index', $data);
    }

    public function status(Request $request)
    {

        $po = ProductOrder::find($request->order_id);
        $po->order_status = $request->order_status;
        $po->save();

        $user = User::findOrFail($po->user_id);
        $bs = BasicSetting::first();

        $status = $request->order_status;
        $templateType = 'pending';

        if ($status == 'received') {
            $templateType = 'order_received';
        } elseif ($status == 'preparing') {
            $templateType = 'order_preparing';
        } elseif ($status == 'ready_to_pick_up') {
            $templateType = 'order_ready_to_pickup';
        } elseif ($status == 'picked_up') {
            $templateType = 'order_pickedup';
        } elseif ($status == 'delivered') {
            $templateType = 'order_delivered';
        } elseif ($status == 'cancelled') {
            $templateType = 'order_cancelled';
        } else {
            Session::flash('success', 'Order status changed successfully!');
            return back();
        }

        $mailer = new MegaMailer();
        $data = [
            'toMail' => $user->email,
            'toName' => $user->fname,
            'customer_name' => $user->fname,
            'order_number' => $po->order_number,
            'order_link' => "<a href='" . route('user-orders-details',$po->id) . "'>" . route('user-orders-details',$po->id) . "</a>",
            'website_title' => $bs->website_title,
            'templateType' => $templateType,
            'type' => 'foodOrderStatus'
        ];
        $mailer->mailFromAdmin($data);

        Session::flash('success', 'Order status changed successfully!');
        return back();
    }

    public function details($id)
    {
        $order = ProductOrder::findOrFail($id);
        return view('admin.product.order.details',compact('order'));
    }


    public function bulkOrderDelete(Request $request)
    {
        $ids = $request->ids;

        foreach ($ids as $id) {
            $order = ProductOrder::findOrFail($id);
            @unlink('assets/front/invoices/product/'.$order->invoice_number);
            @unlink('assets/front/receipt/'.$order->receipt);
            foreach($order->orderitems as $item){
                $item->delete();
            }
            $order->delete();
        }

        Session::flash('success', 'Orders deleted successfully!');
        return "success";
    }

    public function orderDelete(Request $request)
    {
        $order = ProductOrder::findOrFail($request->order_id);
        @unlink('assets/front/invoices/product/'.$order->invoice_number);
        foreach($order->orderitems as $item){
            $item->delete();
        }
        $order->delete();

        Session::flash('success', 'product order deleted successfully!');
        return back();
    }

}
