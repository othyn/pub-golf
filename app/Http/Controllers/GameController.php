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
    public function store(Request $request) {

        $request->validate([
            'name'           => 'required|min:1|max:50',
            'organiser_name' => 'required|min:1|max:50'
        ]);

        /*
            try {

                $game->create([
                    'name'            => $request->name,
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

        $game = Game::create([
            'name' => $request->name
        ]);

        $player = $game->players()->create([
            'name'     => $request->organiser_name,
            'is_admin' => true
        ]);
        // Careful with mass assignment of is_admin to explicitly build
        // the data array

        $request->session()->put('player_id', $player->id);
        // Set what player the user is using

        return redirect()->route('game.edit', compact('game'));
    }

    /**
     * Let's play a game!
     * Limited to players of the game only
     *
     * @param  Game   $game Game instance
     * @return View         Play View instance
     */
    public function play(Game $game) {

        $playerID = session()->get('player_id');

        $player = $game->players()->where('id', $playerID)->first();

        // TODO: Better way of doing this...

        return view('play', compact('game', 'player'));
    }

    /**
     * Edit the game
     * Limited to admins of the game only
     *
     * @param  Game   $game Game instance to manage
     * @return View         Edit View instance
     */
    public function edit(Game $game) {

        $playerID = session()->get('player_id');

        $player = $game->players()->where('id', $playerID)->first();

        // TODO: Better way of doing this...

        return view('edit', compact('game', 'player'));
    }
}
