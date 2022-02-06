<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderActionRequest;
use App\Models\OrderHistory;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;

class OrderHistoryController extends Controller
{
    public function history(OrderActionRequest $request){
        $order_tracking_no = $request->input('order_tracking_no');  
        try{
            $histories = DB::table('order_histories')
                        ->select([
                            'order_histories.message',
                            'users.name as user_name',
                            'order_histories.date_time',
                        ])
                        ->leftJoin('users', 'order_histories.user_id', '=', 'users.id')
                        ->where('order_histories.order_tracking_no', $order_tracking_no)
                        ->get();           
            return $this->successApiResponse(200, 'Order Delivery Successfully', $histories);
        }catch(Exception $e){
            return $this->failedApiResponse(500, $e->getMessage());
        }
    }
}
