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

// TODO: Rate limiting
// - https://laravel.com/docs/5.6/routing#rate-limiting
// - https://scotch.io/tutorials/understanding-laravel-middleware
//
// TODO: Middleware for session user ID check

/**
 * Landing routes
 */

Route::view('/', 'home')->name('home');


/**
 * Game routes
 */

Route::post('/game/create', 'GameController@create')->name('game.create');

Route::get('/game/join/{game}', 'GameController@showJoin')->name('game.join');
Route::post('/game/join/{game}', 'GameController@join');

Route::get('/game/edit/{game}', 'GameController@edit')->name('game.edit');

Route::get('/game/play/{game}', 'GameController@play')->name('game.play');
