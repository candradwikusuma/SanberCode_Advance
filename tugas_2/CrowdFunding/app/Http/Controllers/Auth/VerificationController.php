<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use App\User;
use App\OtpCode;
use App\Http\Requests\Auth\VerificationRequest;

class VerificationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(VerificationRequest $request)
    {
        $otp=OtpCode::where('otp',$request->otp)->first();
        
        if(!$otp){
            return response()->json([
            'response_code'=>'01',
            'response_message'=>'Kode Otp tidak ditemukan',
            
            ],200);
        }

        $now=Carbon::now();

        if($now>$otp->expired_date){
            return response()->json([
                'response_code'=>'01',
                'response_message'=>'Kode Otp sudah expired, silahkan regenerate kode otp',
                
                ],200);
        }

        //update
        $user=User::findOrFail($otp->user_id);
        $user->email_verified_at=Carbon::now();
        $user->save();

        //delet
        $otp->delete();

        $data_user['user']=$user;

        return response()->json([
            'response_code'=>'00',
            'response_message'=>'User telah berhasil diverifikasi',
            'data'=>$data_user
        ]);
    }
}
