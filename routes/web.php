<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('welcome');

Auth::routes();

Route::middleware('auth')->namespace('App\Http\Controllers\Author')->group(function () {
  Route::get('/home','HomeController@index')->name('home');
  Route::resource('/paper', 'PaperController');
});


Route::prefix('/chair')->middleware('auth.chair')->namespace('App\Http\Controllers\Chair')->group(function () {
  Route::get('/', 'HomeController@index')->name('chair.dashboard');
  Route::get('/users', 'UsersController@index')->name('chair.users.index');	
  Route::get('papers' , 'PapersController@index')->name('chair.papers.index');
  Route::get('settings', 'SettingsController@index')->name('chair.settings');
});


Route::prefix('/reviewer')->middleware('auth.reviewer')->namespace('App\Http\Controllers\Reviewer')->group(function () {
     Route::get('/', 'HomeController@index')->name('reviewer.home');
     Route::get('/reviews', 'ReviewsController@index')->name('reviewer.reviews.index');      
      Route::get('/reviews/history', 'ReviewsController@history')->name('reviewer.reviews.history');
});

Route::get('pdf/{file}' , function($file){
    return
    response()->file(storage_path('app/public/papers/'.$file),[
      'Content-Type' => 'application/pdf',
      'Content-Disposition' => 'inline; filename="'.$file.'"'
      
    ]);
  })->name('paper.print');
