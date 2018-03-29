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
| FYI: AJAX endpoints in here as they are stateful
*/

/**
 * Landing routes
 */

Route::view('/', 'home')->name('home');


/**
 * Game routes
 */

Route::post('/games', 'GameController@store');

Route::get ('/games/{game}/join', 'JoinController@index')->name('game.join');
Route::post('/games/{game}/join', 'JoinController@join');

Route::get('/games/{game}/play', 'GameController@play')->name('game.play')
                                                       ->middleware('user');

Route::get('/games/{game}/edit', 'GameController@edit')->name('game.edit')
                                                       ->middleware('user', 'admin');


/**
 * AJAX Game routes
 */

Route::middleware('user', 'throttle:100,1')->group(function () {

    Route::get('/games/{game}/active-hole', 'GameController@activeHole');
    Route::get('/games/{game}/leaderboard', 'GameController@leaderboard');

});

Route::middleware('user', 'throttle:100,1')->group(function () {

    Route::patch('/games/{game}/players/{player}/score', 'PlayerController@update');

});


Route::middleware('user', 'admin', 'throttle:75,1')->group(function () {

    Route::put('/games/{game}/active-hole/{hole}', 'GameController@setActiveHole');

});
