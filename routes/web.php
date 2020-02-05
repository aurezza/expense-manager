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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::post('/loginv2', 'Auth\LoginController@login');
Route::get('/', function () {
  return redirect('/login');
});

//ROLES
Route::group(['prefix' => 'role', 'middleware' => 'auth'], function () {
  Route::get('/', 'RoleController@index');
  Route::get('getlist', 'RoleController@getList');
  Route::post('add', 'RoleController@store');
  Route::post('update/{id}', 'RoleController@update');
  Route::post('delete/{id}', 'RoleController@destroy');
});

//EXPENSE CATEGORY
Route::group(['prefix' => 'expensecategory', 'middleware' => 'auth'], function () {
  Route::get('/', 'ExpenseCategoryController@index');
  Route::get('getlist', 'ExpenseCategoryController@getList');
  Route::post('add', 'ExpenseCategoryController@store');
  Route::post('update/{id}', 'ExpenseCategoryController@update');
  Route::post('delete/{id}', 'ExpenseCategoryController@destroy');
});

//EXPENSE
Route::group(['prefix' => 'expense', 'middleware' => 'auth'], function () {
  Route::get('/', 'ExpenseController@index');
  Route::get('getlist', 'ExpenseController@getList');
  Route::post('add', 'ExpenseController@store');
  Route::post('update/{id}', 'ExpenseController@update');
  Route::post('delete/{id}', 'ExpenseController@destroy');
});

//USERS
Route::middleware('auth')->get('/account', 'UserController@edit');
Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
  Route::get('/', 'UserController@index');
  Route::get('getlist', 'UserController@getList');
  Route::post('add', 'UserController@store');
  Route::post('update/{id}', 'UserController@update');
  Route::post('updateaccount', 'UserController@editAccount');
  Route::post('delete/{id}', 'UserController@destroy');
});


Route::get('/dashboard', 'HomeController@index')->name('home');
