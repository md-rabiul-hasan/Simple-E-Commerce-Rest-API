<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderActionRequest;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;

class OrderSearchController extends Controller
{
    public function search(OrderActionRequest $request){
        $order_tracking_no = $request->input('order_tracking_no');  
        try{
            $orders = Order::select(['id','amount','shipping_address','order_tracking_no','date','status'])->where('order_tracking_no',$order_tracking_no)->first();
            if($orders){
                return $this->successApiResponse(200, 'Order Searching Result', $orders);
            }else{
                return $this->failedApiResponse(400, "Order not found");
            }            
        }catch(Exception $e){
            return $this->failedApiResponse(500, $e->getMessage());
        } 
    }
}
