<?php

namespace App\Http\Middleware;

use Closure;

class EmailVerifiedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user=Auth()->user();

        if($user->email_verified_at != null && $user->password != null){
            return $next($request);

        }
        else{
            return response('Email belum Terverifikasi, Silahkan cek Email anda!');
        }

    }
}
