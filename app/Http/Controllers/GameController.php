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

        $game = Game::create(request(['name']));

        // try {

        //     $game->create([
        //         'name'            => request('name'),
        //         'admin_player_id' => 0
        //     ]);

        // } catch (Illuminate\Database\QueryException $e) {

        //     $errorCode = $e->errorInfo[1];

        //     if ($errorCode == 1062)
        //         return back(); // Needs errors
        // }
        // TODO: Need to account for duplicates
        // Would do a while on DB check or something similar...

        $player = $game->addPlayer(request('organiser_name'));

        $game->admin_player_id = $player->id;

        $game->save();

        // Add player to session
        // Create middleware to check for ID in session on
        // play & manage?

        // Redirect to ManageController@index with game obj

        return redirect()->route('game.edit', [$game]);

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

        $player = $game->addPlayer(request('name'));

        // Add player to session
        // Create middleware to check for ID in session on
        // play & manage?

        // Redirect to PlayController@index

        return back();

        //return view('play', ['game_code' => $game->game_code]);
    }
}
