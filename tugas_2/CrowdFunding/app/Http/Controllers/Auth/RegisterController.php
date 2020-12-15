<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Events\UserRegistered;
use App\User;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterRequest $request)
    {


        $data=$request->all();
        $user=User::create($data);

        event(new UserRegistered($user,'register'));
        $data_user['user']=$user;

        return response()->json([
            'response_code'=>'00',
            'response_message'=>'User telah didaftarkan, untuk masukkan kode otp silahkan cek email anda',
            'data_user'=>$data_user
        ]);
    }
}
