<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy http_build_cookie(cookie)ng your API!
|	
 */

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
//controlador cliente->customers
Route::post('/customers/{id}/update', 'CustomersController@update');
Route::delete('/customers/{id}/delete', 'CustomersController@destroy');
Route::resource('/customers', 'CustomersController');


//controlador transanctions
Route::get('transactions/show/{id}', 'TransactionsController@show');
Route::post('transactions/{id}/update', 'TransactionsController@update');
Route::delete('transactions/{id}/delete', 'TransactionsController@destroy');
Route::resource('/transactions', 'TransactionsController');
