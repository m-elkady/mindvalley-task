<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/post/{id}', 'HomeController@post');


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function ($router) {

    Route::group(['namespace' => '\App\Modules\Users\Controllers'], function ($router) {
        Route::get('login', 'AdminController@login')->name('login');
        Route::post('login', 'AdminController@handleLogin');

        Route::group(['middleware' => 'isAdmin'], function () {
            Route::get('/', 'AdminController@home')->name('home');
            Route::get('logout', 'AdminController@logout')->name('logout');
        });
    });

    Route::group(['namespace'  => '\App\Modules\Articles\Controllers',
                  'prefix'     => 'articles',
                  'middleware' => 'isAdmin',
                  'as'         => 'articles.'
    ], function ($router) {
        Route::get('/', 'ArticlesController@index')->name('index');
        Route::get('add', 'ArticlesController@add');
        Route::post('add', 'ArticlesController@create')->name('add');
        Route::get('edit/{id}', 'ArticlesController@edit');
        Route::post('edit/{id}', 'ArticlesController@update')->name('edit');
        Route::get('delete/{id}', 'ArticlesController@delete')->name('delete');
        Route::post('do-operation', 'ArticlesController@doOperation')->name('doOperation');
//        Route::get('view/{id}', 'ArticlesController@view')->name('view');
    });

});
