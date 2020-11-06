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

use Illuminate\Support\Facades\Route;

Route::name('post')->prefix('post')->group(function () {
    Route::get('/', 'PostController@index');
    Route::get('delete','PostController@destroy')->name('delete');
   Route::post('update','PostController@update')->name('update');
});

Route::resource('post','PostController');
