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

Route::get('/', ['as' => 'index', 'uses' => 'companies_controller@index'])->middleware('auth');

Route::resource('companies', 'companies_controller', ['except' => ['delete', 'update']]);
Route::delete('/companies/{company_id}/delete', ['as' => 'companies.delete', 'uses' => 'companies_controller@delete']);

Route::resource('employees', 'employees_controller', ['except' => ['create', 'delete', 'edit', 'show', 'update']]);
Route::get('/employees/create/{employee_id}', ['as' => 'employees.create', 'uses' => 'employees_controller@create']);
Route::get('/employees/{company_id}/edit/{employee_id}', ['as' => 'employees.edit', 'uses' => 'employees_controller@edit']);
Route::get('/employees/{company_id}/{employee_id}', ['as' => 'employees.show', 'uses' => 'employees_controller@show']);
Route::delete('/employees/{employee_id}/delete', ['as' => 'employees.delete', 'uses' => 'employees_controller@delete']);


Route::get('/home', ['as' => 'home.index', 'uses' => 'home_controller@index']);

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();

