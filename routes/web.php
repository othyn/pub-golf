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

Route::get('/', function () {
    return view('join');
});

Route::get('/play', function () {

    $tempData = [
        'game_code' => 'ABCDEFG',
        'holes'     => [
            [
                'name'  => 'Pub A',
                'par'   => 3
            ],
            [
                'name'  => 'Pub B',
                'par'   => 7
            ]
        ],
        'current_hole' => 1,
        'par_total'    => 10,
        'players'      => [
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
        ]
    ];

    return view('play', $tempData);
});
