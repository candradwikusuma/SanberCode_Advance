<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\Auth\RegenerateOtpRequest;

class RegenerateOtpController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegenerateOtpRequest $request)
    {
        $user = User::where('email',$request->email)->first();

        $user->otp_generate();
        $data_user['user']=$user;

        return response()->json([
            'response_code'=>'00',
            'response_message'=>'Otp code sudah berhasil di regenerate, untuk melihat otp code silahkan cek email anda',
            'data'=>$data_user
        ]);
    }
}
