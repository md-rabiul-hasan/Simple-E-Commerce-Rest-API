<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderStoreController extends Controller
{
    public function store(OrderStoreRequest $request){
        $unique_order_tracking_no = uniqid();
        $order                    = new Order();
        $order->amount            = $request->input('amount');
        $order->shipping_address  = $request->input('shipping_address');
        $order->order_tracking_no = $unique_order_tracking_no;
        $order->date              = date('Y-m-d');
        $order->user_id           = Auth::user()->id;

        try{
            $order->save();
            $this->insertOrderDetails($order->id, $request->input('items')); // insert order details
            $this->orderHistory($order->order_tracking_no, "Order Confirmed"); // insert order log
            return $this->successApiResponse(200, 'Product Store Successfully', ["order_tracking_no" => $order->order_tracking_no]);
        }catch(Exception $e){
            return $this->failedApiResponse(500, $e->getMessage());
        }
    }

    public function insertOrderDetails($order_id, $items){        
        for($i=0; $i < count($items); $i++){
            $order_details             = new OrderDetail();
            $order_details->product_id = $items[$i]['product_id'];
            $order_details->order_id   = $order_id;
            $order_details->price      = $items[$i]['price'];
            $order_details->qty        = $items[$i]['qty'];
            $order_details->save();
        }
    }
}
