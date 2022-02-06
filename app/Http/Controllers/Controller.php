<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Customer role id return this function
    */
    public function getCustomerRoleId(){
        return 2;
    }

    /**
     * Formatted and return api success API response
    */
    public function successApiResponse($status, $message, $data = ''){
        $response = [
            "success" => true,
            "status"  => $status,
            "message" => $message,
            "data"    => $data
        ];
        return response()->json($response);
    }

    /**
     * Formatted and return api failed API response
    */
    public function failedApiResponse($status, $message){
        $response = [
            "success" => false,
            "status"  => $status,
            "message" => $message
        ];
        return response()->json($response);
    }
}
