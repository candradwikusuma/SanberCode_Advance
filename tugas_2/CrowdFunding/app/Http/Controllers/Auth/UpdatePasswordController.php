<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\Auth\UpdatePasswordRequest;

class UpdatePasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdatePasswordRequest $request)
    {
        User::where('email',$request->email)
            ->update(['password' => bcrypt(request('password'))]);

        return response()->json([
            'response_code'=>'00',
            'response_message'=>'Password telah diubah'
        ],200);
    }
}
