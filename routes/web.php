<?php

use Illuminate\Support\Facades\Route;

Route::any('/', function () {
	return "test";
  // return redirect('/movie');
});

Route::prefix('/movie')->group(function() {
	Route::get('/', 'MovieController@index')->name('movie');
	Route::get('/{movie}', 'MovieController@show')->name('movie.item');
});

Route::prefix('/tvshow')->group(function() {
	Route::get('/', 'TvShowController@index')->name('tvshow');
	Route::get('/page/{page?}', 'TvShowController@index')->name('tvshow');
	Route::get('/{id}', 'TvShowController@show')->name('tvshow.item');
});

Route::prefix('/actor')->group(function() {
	Route::get('/', 'ActorController@index')->name('actor');
	Route::get('/page/{page?}', 'ActorController@index')->name('actor');
	Route::get('/{actor}', 'ActorController@show')->name('actor.item');
});

