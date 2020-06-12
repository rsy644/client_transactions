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

Route::get('/', function () {
    return view('layouts.admin');
})->middleware('auth');

Route::resource('companies', 'companies_controller');

Route::resource('employees', 'employees_controller', ['except' => ['create', 'delete', 'edit', 'show']]);
Route::get('/employees/create/{employee_id}', ['as' => 'employees.create', 'uses' => 'employees_controller@create']);
Route::get('/employees/{company_id}/edit/{employee_id}', ['as' => 'employees.edit', 'uses' => 'employees_controller@edit']);
Route::get('/employees/{company_id}/{employee_id}', ['as' => 'employees.show', 'uses' => 'employees_controller@show']);
Route::delete('/employees/{employee_id}/delete', ['as' => 'employees.delete', 'uses' => 'employees_controller@delete']);


Route::get('/home', ['as' => 'home.index', 'uses' => 'home_controller@index']);

Auth::routes();

