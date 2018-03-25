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

Route::post('/manage', function () {

    // Create new unique game
    // Create new player for game using nickname and assign them as admin

    return view('manage');
});

Route::get('/manage/{game_code}', function ($gameCode) {

    $tempData = [
        'game_code'   => $gameCode,
        'game_name'   => 'Test game name',
        'max_players' => 10,
        'holes'       => TEMP_holes,
        'players'     => TEMP_players
    ];

    return view('manage', $tempData);
});

Route::post('/play', function () {

    // Check game exists
    // Create player for game from nickname if doesnt exist
    // Load existing if does
    // Goto play page

    return view('play');
});

Route::get('/play/{game_code}', function ($gameCode) {

    $tempData = [
        'game_name'    => 'Test game name',
        'current_hole' => 1,
        'par_total'    => 10,
        'holes'        => TEMP_holes,
        'players'      => TEMP_players
    ];

    return view('play', $tempData);
});
