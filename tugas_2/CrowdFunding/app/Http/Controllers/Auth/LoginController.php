<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(LoginRequest $request)
    {
        if(!$token=auth()->attempt($request->only('email','password'))){
            return response()->json([
                'error'=>'Unauthorized'
            ],401);
        }
        $data['token']=$token;
        $data['user']=auth()->user();

        return response()->json([
            'response_code'=>  '00',
            'response_message'=>'User telah berhasil login',
            'data'=>$data,
        ]);
    }
}
