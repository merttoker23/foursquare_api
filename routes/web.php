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

Route::get('/', 'MainController@index');
Route::get('/category/{category_name}', 'MainController@category');
Route::get('/data_{category_name}.json', 'AjaxController@venues_maps');

//Ajax Post
Route::post('/venues_categories', 'AjaxController@venues_categories');
Route::post('/venues_explore', 'AjaxController@venues_explore');
