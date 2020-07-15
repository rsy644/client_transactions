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

Route::resource('clients', 'ClientController');

Route::resource('transactions', 'transactionController', ['except' => ['create', 'edit', 'show']]);
Route::get('/transactions/create/{transaction_id}', ['as' => 'transactions.create', 'uses' => 'transactionController@create']);
Route::get('/transactions/{client_id}/edit/{transaction_id}', ['as' => 'transactions.edit', 'uses' => 'transactionController@edit']);
Route::get('/transactions/{client_id}/{transaction_id}', ['as' => 'transactions.show', 'uses' => 'transactionController@show']);


Route::get('/home', ['as' => 'home.index', 'uses' => 'homeController@index']);

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();

