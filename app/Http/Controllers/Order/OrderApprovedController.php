<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderActionRequest;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;

class OrderApprovedController extends Controller
{
    public function approved(OrderActionRequest $request){
        $order_tracking_no = $request->input('order_tracking_no');        
        try{
            Order::where('order_tracking_no', $order_tracking_no)->update([
                "status" => 1, // approved order status
            ]);
            $this->orderHistory($order_tracking_no, "Order Approved");
            return $this->successApiResponse(200, 'Order Approved Successfully', ["order_tracking_no" => $order_tracking_no]);
        }catch(Exception $e){
            return $this->failedApiResponse(500, $e->getMessage());
        }
    }
}
