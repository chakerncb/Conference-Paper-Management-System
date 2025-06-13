<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->namespace('App\Http\Controllers\Author')->group(function () {
  Route::get('/home','HomeController@index')->name('home');
  Route::resource('/paper', 'PaperController');
});


Route::prefix('/chair')->middleware('auth.chair')->namespace('App\Http\Controllers\Chair')->group(function () {
  Route::get('/', 'HomeController@index')->name('chair.dashboard');
  Route::get('/users', 'UsersController@index')->name('chair.users.index');	
});
