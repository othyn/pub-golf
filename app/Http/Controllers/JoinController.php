<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Game;
use App\Player;

class JoinController extends Controller {

    /**
     * Verifies game code is legit and loads /join/{game_code}
     * @param  Game   $game Game model instance
     * @return View         join view
     */
    public function index(Game $game) {

        // On fail, show error on /join

        return view('join', ['game_code' => $game->game_code]);
    }

    /**
     * Verifies game exists, create a player for the game and dump the
     * then dump the user at the scorecard
     * @param  Game   $game Game model instance
     * @return void
     */
    public function store(Game $game) {

        $this->validate(request(), [
            'name' => 'required|min:1|max:50'
        ]);

        $game->addPlayer(request('name'));

        // Redirect to PlayController@index

        return back();

        //return view('play', ['game_code' => $game->game_code]);
    }
}
