<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
|
|
*/

Route::get('/', 'PanelController@index')->name('panel');
Route::resource('products', 'ProductController');

Route::get('users', 'UserController@index')->name('users.index');
Route::post('users/admin/{user}', 'UserController@toggleAdmin')->name('users.admin.toggle');
