<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderActionRequest;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;

class OrderRejectedController extends Controller
{
    public function rejected(OrderActionRequest $request){
        $order_tracking_no = $request->input('order_tracking_no');        
        try{
            Order::where('order_tracking_no', $order_tracking_no)->update([
                "status" => 2, // rejected order status
            ]);
            $this->orderHistory($order_tracking_no, "Order Rejected");
            return $this->successApiResponse(200, 'Order Rejected Successfully', ["order_tracking_no" => $order_tracking_no]);
        }catch(Exception $e){
            return $this->failedApiResponse(500, $e->getMessage());
        }
    }
}
