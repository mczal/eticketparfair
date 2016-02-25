<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('layouts.app');
});



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //require auth
    Route::get('orders/cancel', 'OrderController@cancel');
    Route::resource('orders', 'OrderController');
    Route::resource('tickets', 'TicketController');
    Route::resource('types', 'TypeController');
    Route::resource('confirmations', 'ConfirmationController');
    Route::post('confirmations/validate','ConfirmationController@validateOrder');

    //API Android
    Route::get('tickets/get-data/{code}','TicketController@getTicketData');
    Route::get('tickets/check-in','TicketController@checkIn');
});
