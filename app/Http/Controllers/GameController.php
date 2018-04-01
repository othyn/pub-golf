<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Game;
use App\Hole;

class GameController extends Controller {

    /**
     * Handles game creation
     * @param  Request $request     Request object
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
     * Returns the active hole
     * @param  Game   $game Game instance to manage
     * @return array        Active hole
     */
    public function activeHole(Game $game) {

        $hole = $game->activeHole();

        return [
            'location' => $hole->location,
            'drink'    => $hole->drink,
            'par'      => $hole->par,
            'hole'     => $hole->uuid
        ];
    }

    /**
     * Sets the active hole for a game
     * @param  Game   $game Game instance
     * @param  Hole   $hole Hole instance
     * @return void
     */
    public function setActiveHole(Game $game, Hole $hole) {

        $game->holes()->update(['is_active' => 0]);

        $hole->is_active = true;
        $hole->save();

        return [
            'location' => $hole->location,
            'drink'    => $hole->drink,
            'par'      => $hole->par
        ];
    }

    /**
     * Returns the refreshed leaderboard
     * THIS IS A BAD WAY OF DOING IT?
     * VueJS would be perfect here, feeding data to a client side template
     * @param  Game   $game Game instance to manage
     * @return array        Active hole
     */
    public function leaderboard(Game $game) {

        $playerID = session()->get('player_id');

        $player = $game->players()->where('id', $playerID)->first();

        // TODO: Better way of doing this...

        return view('components.leaderboard', compact('game', 'player'));
    }

    /**
     * Edit the game
     * Limited to admins of the game only
     * @param  Game   $game Game instance to manage
     * @return View         Edit View instance
     */
    public function edit(Game $game) {

        $playerID = session()->get('player_id');

        $player = $game->players()->where('id', $playerID)->first();

        // TODO: Better way of doing this...

        return view('edit', compact('game', 'player'));
    }

    /**
     * Updates the primary game stuff; name, max players, etc...
     * @param  Request $request Request object
     * @param  Game    $game    Game instance
     * @return void
     */
    public function update(Request $request, Game $game) {

        $request->validate([
            'name'        => 'required|min:1|max:50',
            'max_players' => 'required|digits_between:1,2'
        ]);

        $game->update([
            'name'        => $request->name,
            'max_players' => $request->max_players
        ]);
    }
}
