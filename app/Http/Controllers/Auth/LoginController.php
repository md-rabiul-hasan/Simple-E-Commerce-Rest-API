<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(LoginFormRequest $request){
        $credentials = [
            "email"    => $request->input('email'),
            "password" => $request->input('password')
        ];
        if (!$token = auth()->attempt($credentials)) {
            return $this->failedApiResponse(401, "Your email or password was incorrect");
        }

        return $this->successApiResponse(200, "Login Successfully", $this->respondWithToken($token));

    }

     /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return[
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }


}
