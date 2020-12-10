<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/route-1', function(){
    return 'Selamat Datang di route 1';
})->middleware(['auth','email.verified']);
Route::get('/route-2',function(){
    return 'Selamat Datang di route 2';
})->middleware(['auth','email.verified','admin']);


