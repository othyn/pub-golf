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

define('TEMP_holes', [
    [
        'location' => 'Pub A',
        'drink'    => 'Shots',
        'par'      => 3
    ],
    [
        'location' => 'Pub B',
        'drink'    => 'Water',
        'par'      => 7
    ]
]);

define('TEMP_players', [
    [
        'nickname'    => 'Jess',
        'scores'      => [2, 3],
        'score_total' => 5
    ],
    [
        'nickname'    => 'Jill',
        'scores'      => [3, 5],
        'score_total' => 8
    ],
    [
        'nickname'    => 'Bob',
        'scores'      => [1, 8],
        'score_total' => 9
    ],
    [
        'nickname'    => 'Mark',
        'scores'      => [4, 7],
        'score_total' => 11
    ],
]);

Route::view('/', 'home');

Route::post('/game/create', 'GameController@create');

Route::get('/game/join/{game}', function (Game $game) {

    return view('join', ['game_code' => $game->game_code]);
});

Route::post('/game/join/{game}', 'GameController@join');

Route::get('/game/manage/{game}', function ($gameCode) {

    $tempData = [
        'game_code'   => $gameCode,
        'name'        => 'Test game name',
        'max_players' => 10,
        'holes'       => TEMP_holes,
        'players'     => TEMP_players
    ];

    return view('manage', $tempData);
});

Route::post('/game/play', function () {

    // Check game exists
    // Create player for game from nickname if doesnt exist
    // Load existing if does
    // Goto play page

    return view('play');
});

Route::get('/game/play/{game}', function ($gameCode) {

    $tempData = [
        'name'         => 'Test game name',
        'current_hole' => 1,
        'par_total'    => 10,
        'holes'        => TEMP_holes,
        'players'      => TEMP_players
    ];

    return view('play', $tempData);
});
