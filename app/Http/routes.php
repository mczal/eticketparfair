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

Route::get('/', 'FrontendController@welcome');
Route::get('admin', function(){
    return redirect('/orders');
});

Route::group(['prefix' => 'api'], function(){
    Route::post('login', 'Api\AuthenticateController@authenticate');
    Route::get('check-in/{unique_code}', 'Api\TicketController@checkIn');
});

//USER web


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

//testing

Route::group(['middleware' => ['web']], function () {
    // Route::get('/login', 'Auth\AuthController@showLoginForm');
    // Route::post('/login', 'Auth\AuthController@login');
    // Route::get('/logout', 'Auth\AuthController@logout');
    Route::auth();
    //require auth
    Route::get('orders/cancel', 'OrderController@cancel');
    Route::post('orders/store-offline','OrderController@storeOffline');
    Route::get('orders/create-offline','OrderController@createOffline');
    Route::resource('orders', 'OrderController');

    /*TEST*/
    Route::get('tickets/create-check-in',function(){
      return view('tickets.create-check-in');
    });
    /*TEST*/
    Route::resource('tickets', 'TicketController');
    Route::get('tickets/print/{unique_code}', 'TicketController@printTicket');

    Route::get('types/print/{id}', 'TypeController@printTicket');
    Route::resource('types', 'TypeController');

    Route::resource('confirmations', 'ConfirmationController');
    Route::post('confirmations/validate','ConfirmationController@validateOrder');

    Route::get('buy', 'FrontendController@buy');
    Route::post('buy', 'FrontendController@buyStore');
    Route::get('confirmation', 'FrontendController@confirmation');
    Route::post('confirmation', 'FrontendController@confirmationStore');

    //API Android
    Route::get('tickets/get-data/{code}','api\TicketController@getTicketData');
    Route::post('tickets/check-in','api\TicketController@checkIn');

});
