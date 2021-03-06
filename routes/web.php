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
 * Landing routes.
 */
Route::view('/', 'home')->name('home');

/*
 * Game routes
 */

Route::post('/games', 'GameController@store');

Route::get('/games/{game}/join', 'JoinController@index')->name('game.join');
Route::post('/games/{game}/join', 'JoinController@join');

Route::get('/games/{game}/play', 'GameController@play')->name('game.play')
                                                       ->middleware('user:play');

Route::get('/games/{game}/edit', 'GameController@edit')->name('game.edit')
                                                       ->middleware('user:edit', 'admin');

/*
 * AJAX Game routes
 */

Route::middleware('user:play', 'throttle:250,1')->group(function () {
    Route::get('/games/{game}/active-hole', 'GameController@activeHole');
    Route::get('/games/{game}/leaderboard', 'GameController@leaderboard');
});

Route::middleware('user:play', 'throttle:250,1')->group(function () {
    Route::patch('/games/{game}/players/{player}/score', 'PlayerController@update');
});

Route::middleware('user:edit', 'admin', 'throttle:75,1')->group(function () {
    Route::post('/games/{game}', 'GameController@update');
    Route::put('/games/{game}/active-hole/{hole}', 'GameController@setActiveHole');
});

Route::middleware('user:edit', 'admin', 'throttle:75,1')->group(function () {
    Route::post('/games/{game}/hole', 'HoleController@store');
    Route::post('/games/{game}/hole/{hole}', 'HoleController@update');
    Route::delete('/games/{game}/hole/{hole}', 'HoleController@destroy');
});

Route::middleware('user:edit', 'admin', 'throttle:75,1')->group(function () {
    Route::post('/games/{game}/players/{player}/penalise', 'PlayerController@penalise');
    Route::delete('/games/{game}/players/{player}', 'PlayerController@destroy');
});
