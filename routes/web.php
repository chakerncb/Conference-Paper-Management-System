<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/chair')->middleware('auth.chair')->namespace('App\Http\Controllers\Chair')->group(function () {
    
  Route::get('/', 'HomeController@index')->name('chair.dashboard');
  Route::resource('/users', 'UsersController');

});
