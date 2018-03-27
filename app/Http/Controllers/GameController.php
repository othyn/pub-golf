<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Game;

class GameController extends Controller {

    /**
     * Handles game creation
     * @return void
     */
    public function create() {

        $this->validate(request(), [
            'name'           => 'required|min:1|max:50',
            'organiser_name' => 'required|min:1|max:50'
        ]);

        $game = Game::create([request('name')]);

        $game->addPlayer(request('organiser_name'));

        // Redirect to ManageController@index with game obj

        return back();

        //return view('manage', ['game_code' => $game->game_code]);
    }

    /**
     * Verifies game exists, created a player for the game,
     * then dumps the player at the scorecard
     * @param  Game   $game Game model instance
     * @return void
     */
    public function join(Game $game) {

        $this->validate(request(), [
            'name' => 'required|min:1|max:50'
        ]);

        $game->addPlayer(request('name'));

        // Redirect to PlayController@index

        return back();

        //return view('play', ['game_code' => $game->game_code]);
    }
}
