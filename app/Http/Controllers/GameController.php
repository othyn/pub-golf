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

        $game = Game::create(request(['name']));

        $player = $game->players()->create([
            'name'     => request('organiser_name'),
            'is_admin' => true
        ]);
        // Careful with mass assignment of is_admin to explicitly build
        // the data array

        $request->session()->put('player_id', $player->id);
        // Set what player the user is using

        return redirect()->route('game.edit', compact('game'));
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

        if (!$player = $game->players()->where('name', request('name'))->first()) {

            // If a player doesn't already exist for this game...

            if ($game->players()->count() >= $game->max_players) {

                $request->session()->flash('message.warning', 'Sorry, this game has run out of available spaces. 😭 Ask your fun coordinator to add more!');

                return redirect('/');
            }
            // ... check that there are available spaces ...

            $player = $game->players()->create([
                'name' => request('name')
            ]);
            // ... and create the game
            // Being careful with mass assignment of is_admin to explicitly build
            // the data array
        }

        $request->session()->put('player_id', $player->id);
        // Set what player the user is using

        if ($player->is_admin)
            return redirect()->route('game.edit', compact('game'));
        else
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
