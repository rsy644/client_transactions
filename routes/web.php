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

Route::get('/', ['as' => 'clients.index', 'uses' => 'clients_controller@index'])->middleware('auth');


Route::get('/clients/create', ['as' => 'clients.create', 'uses' => 'clients_controller@create']);
Route::post('/clients', ['as' => 'clients.store', 'uses' => 'clients_controller@store']);
Route::get('/clients/{client}', ['as' => 'clients.show', 'uses' => 'clients_controller@show']);
Route::get('/clients/{client}/edit', ['as' => 'clients.edit', 'uses' => 'clients_controller@edit']);
Route::put('/clients/{client}/update', ['as' => 'clients.update', 'uses' => 'clients_controller@update']);





Route::delete('/clients/{client_id}/delete', ['as' => 'clients.delete', 'uses' => 'clients_controller@delete']);

Route::resource('transactions', 'transactions_controller', ['except' => ['create', 'delete', 'edit', 'show', 'update']]);
Route::get('/transactions/create/{transaction_id}', ['as' => 'transactions.create', 'uses' => 'transactions_controller@create']);
Route::get('/transactions/{client_id}/edit/{transaction_id}', ['as' => 'transactions.edit', 'uses' => 'transactions_controller@edit']);
Route::get('/transactions/{client_id}/{transaction_id}', ['as' => 'transactions.show', 'uses' => 'transactions_controller@show']);
Route::delete('/transactions/{transaction_id}/delete', ['as' => 'transactions.delete', 'uses' => 'transactions_controller@delete']);


Route::get('/home', ['as' => 'home.index', 'uses' => 'home_controller@index']);

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();

