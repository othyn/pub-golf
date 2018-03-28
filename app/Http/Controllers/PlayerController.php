<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Game;
use App\Player;

class PlayerController extends Controller {

    /**
     * Handles updating the players score
     * @param  Request $request HTTP Request
     * @param  Game    $game    Game instance
     * @param  Player  $player  Player instance
     * @return array            Request success state
     */
    public function update(Request $request, Game $game, Player $player) {

        $sessionPlayerID = $request->session()->get('player_id');

        if ($player->id != $sessionPlayerID)
            abort(401);
        // Wrong user, Unauthorized

        $this->validate($request, [
            'score' => 'required|min:0|max:100'
        ]);

        $score = $request->score - $game->activeHole()->par;

        $player->updateScore($game, $score);

        return [
            'score' => $score
        ];
    }
}
