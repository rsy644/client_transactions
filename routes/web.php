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

Route::get('/', ['as' => 'clients.index', 'uses' => 'clientController@index'])->middleware('auth');


Route::get('/clients/create', ['as' => 'clients.create', 'uses' => 'clientController@create']);
Route::post('/clients', ['as' => 'clients.store', 'uses' => 'clientController@store']);
Route::get('/clients/{client}', ['as' => 'clients.show', 'uses' => 'clientController@show']);
Route::get('/clients/{client}/edit', ['as' => 'clients.edit', 'uses' => 'clientController@edit']);
Route::put('/clients/{client}/update', ['as' => 'clients.update', 'uses' => 'clientController@update']);
Route::delete('/clients/{client}/delete', ['as' => 'clients.delete', 'uses' => 'clientController@delete']);





Route::delete('/clients/{client_id}/delete', ['as' => 'clients.delete', 'uses' => 'clientController@delete']);
Route::get('/transactions', ['as' => 'transactions.index', 'uses' => 'transactionController@index']);
Route::resource('transactions', 'transactionController', ['except' => ['create', 'delete', 'edit', 'show', 'update']]);
Route::get('/transactions/create/{transaction_id}', ['as' => 'transactions.create', 'uses' => 'transactionController@create']);
Route::get('/transactions/{client_id}/edit/{transaction_id}', ['as' => 'transactions.edit', 'uses' => 'transactionController@edit']);
Route::get('/transactions/{client_id}/{transaction_id}', ['as' => 'transactions.show', 'uses' => 'transactionController@show']);
Route::delete('/transactions/{transaction_id}/delete', ['as' => 'transactions.delete', 'uses' => 'transactionController@delete']);

Route::get('/home', ['as' => 'home.index', 'uses' => 'homeController@index']);

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();

