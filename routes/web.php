<?php

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
Route::get('/verify/{confirmation_token}','\Auth\EmailController@verify')->name('verify');

Route::get('/test',function(){
    $confirmation_token = str_random(40);
    $url= route('verify',['confirmation_token' =>$confirmation_token]);
    dd($url);

});