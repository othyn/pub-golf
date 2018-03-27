<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Game;

class GameController extends Controller {

    /**
     * Handles game creation
     *
     * @return RedirectResponse     Play RedirectResponse
     */
    public function create(Request $request) {

        $this->validate(request(), [
            'name'           => 'required|min:1|max:50',
            'organiser_name' => 'required|min:1|max:50'
        ]);

        $game = Game::create(request(['name']));

        /*
            try {

                $game->create([
                    'name'            => request('name'),
                    'admin_player_id' => 0
                ]);

            } catch (Illuminate\Database\QueryException $e) {

                $errorCode = $e->errorInfo[1];

                if ($errorCode == 1062)
                    return back(); // Needs errors
            }
            TODO: Need to account for duplicates
            Would do a while on DB check or something similar...
         */


        $player = $game->addPlayer(request('organiser_name'));

        $game->admin_player_id = $player->id;

        $game->save();

        $request->session()->put('player_id', $player->id);

        return redirect()->route('game.edit', [$game]);
    }

    /**
     * Landing handling for /game/join/{game}
     *
     * @param  Game   $game Game instance
     * @return View         Join View instance
     */
    public function showJoin(Game $game) {

        return view('join', compact('game'));
    }

    /**
     * Creates a player onto a game
     * Then sends the newly created player to play the game
     *
     * @param  Game             $game   Game model instance
     * @return RedirectResponse         Play RedirectResponse
     */
    public function join(Request $request, Game $game) {

        $this->validate(request(), [
            'name' => 'required|min:1|max:50'
        ]);

        $player = $game->addPlayer(request('name'));

        $request->session()->put('player_id', $player->id);
        // Set the game

        return redirect()->route('game.play', compact('game'));
    }

    /**
     * Let's play a game!
     * Limited to players of the game only
     *
     * @param  Game   $game Game instance
     * @return View         Play View instance
     */
    public function play(Game $game) {

        // TODO: Middleware?
        // - Has user in session
        // - Is valid on game for user in session
        // - Game is open to play (needs Holes)

        $tempData = [
            'name'         => 'Test game name',
            'current_hole' => 1,
            'par_total'    => 10,
            'holes'        => [
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
            ],
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

        return view('play', compact('game'));
    }

    /**
     * Edit the game
     * Limited to admins of the game only
     *
     * @param  Game   $game Game instance to manage
     * @return View         Edit View instance
     */
    public function edit(Game $game) {

        // TODO: Middleware?
        // - Has user in session
        // - Is valid on game for user in session
        // - User is admin for game

        $tempData = [
            'game_code'   => $gameCode,
            'name'        => 'Test game name',
            'max_players' => 10,
            'holes'       => [
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
            ],
            'players'     => [
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

        return view('edit', compact('game'));
    }
}
