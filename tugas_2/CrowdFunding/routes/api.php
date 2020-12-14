<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth','middleware'=>'api','namespace'=>'Auth'], function () {
    Route::post('register', 'RegisterController');
    Route::post('regenerate','RegenerateOtpController');
    Route::post('verification','VerificationController');
    Route::post('update-password','UpdatePasswordController');
    Route::post('login','LoginController');
});

Route::group([
    'middleware' => ['api','email_verified','auth:api'],
   
], 
    function () {
    Route::get('profile/show', 'ProfileController@show');
    Route::post('profile/update', 'ProfileController@update');
});
