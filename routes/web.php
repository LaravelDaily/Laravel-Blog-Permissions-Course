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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {
    Route::resource('articles', 'ArticleController');
    Route::view('invite', 'invite')->name('invite');

    Route::get('join', 'JoinController@create')->name('join.create');
    Route::post('join', 'JoinController@store')->name('join.store');

    Route::get('organization/{organization_id}', 'JoinController@organization')->name('organization');

    // Administrator routes
    Route::group(['middleware' => 'is_admin'], function() {
        Route::resource('categories', 'CategoryController');
    });
});
