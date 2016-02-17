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
    //type
    Route::get('/types', 'TypeController@index');
    Route::get('/types/create', 'TypeController@create');
    Route::post('/types/store', 'TypeController@store');



    //ticket
    Route::resource('tickets','TicketController');
    /*Route::get('/tickets','TicketController@index');
    Route::get('/tickets/create','TicketController@create');
    Route::get('/tickets/{id}','TicketController@single');

    Route::get('/test','TicketController@create');
    */
});
