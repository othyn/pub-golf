<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Game;

class JoinController extends Controller {

    /**
     * Landing handling for /game/join/{game}
     *
     * @param  Game   $game Game instance
     * @return View         Join View instance
     */
    public function index(Game $game) {

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
}
