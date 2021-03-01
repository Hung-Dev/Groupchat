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

Route::post('send-message','ChatController@store');
Route::get('/chat/{id}',  'ChatController@callmessage');
Auth::routes();

Route::get('/message/{id}', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@allmessage')->name('home');
Route::get('/home', 'HomeController@allmessage');
Route::get('/json','HomeController@jsonResponse');
Route::get('/sound/','ChatController@soundCheck');
Route::get('/seen/','ChatController@seenMessage');
Route::get('/seenUpdate/','ChatController@seenUpdate');
Route::get('/allmessageview/','ChatController@allMessageView');
Route::get('/singleSeenUpdate/{id}','ChatController@singleSeenUpdate');
Route::post('/typing/','ChatController@typing');
Route::get('/deletemessage/{id}','ChatController@deletemessage');
Route::get('/typing-receve/{id}','ChatController@typinc_receve');
Route::get('/users/','Usercontroller@index')->name('users');