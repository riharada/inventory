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
    return view('welcome');
});


Route::group(['prefix' =>'admin', 'middleware'=>'auth'], function() {
  Route::get('inventory/create','Admin\InventoryController@add');
  Route::post('inventory/create', 'Admin\InventoryController@create');
  Route::get('inventory', 'Admin\InventoryController@index');
  Route::get('inventory/edit', 'Admin\InventoryController@edit');
  Route::post('inventory/edit', 'Admin\InventoryController@update');
  Route::get('inventory/delete', 'Admin\InventoryController@delete');
  });
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'InventoryController@index');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
