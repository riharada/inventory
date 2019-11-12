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
  Route::get('inventory/create','Admin\InventoriesController@add');
  Route::post('inventory/create', 'Admin\InventoriesController@create');
  Route::get('inventory', 'Admin\InventoriesController@index');
  Route::get('inventory/edit', 'Admin\InventoriesController@edit');
  Route::post('inventory/edit', 'Admin\InventoriesController@update');
  Route::get('inventory/delete', 'Admin\InventoriesController@delete');
  });
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'InventoriesController@index');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
