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

Route::get('/', ['as' => 'index', 'uses' => 'clients_controller@index'])->middleware('auth');

Route::resource('clients', 'clients_controller', ['except' => ['delete', 'update']]);
Route::delete('/clients/{client_id}/delete', ['as' => 'clients.delete', 'uses' => 'clients_controller@delete']);

Route::resource('transactions', 'transactions_controller', ['except' => ['create', 'delete', 'edit', 'show', 'update']]);
Route::get('/transactions/create/{transaction_id}', ['as' => 'transactions.create', 'uses' => 'transactions_controller@create']);
Route::get('/transactions/{client_id}/edit/{transaction_id}', ['as' => 'transactions.edit', 'uses' => 'transactions_controller@edit']);
Route::get('/transactions/{client_id}/{transaction_id}', ['as' => 'transactions.show', 'uses' => 'transactions_controller@show']);
Route::delete('/transactions/{transaction_id}/delete', ['as' => 'transactions.delete', 'uses' => 'transactions_controller@delete']);


Route::get('/home', ['as' => 'home.index', 'uses' => 'home_controller@index']);

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();

