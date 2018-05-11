<?php

namespace App\Http\Controllers;

use App\Game;
use App\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Handles updating the players score.
     * @param  Request $request HTTP Request
     * @param  Game    $game    Game instance
     * @param  Player  $player  Player instance
     * @return array            Request success state
     */
    public function update(Request $request, Game $game, Player $player)
    {
        $sessionPlayerID = $request->session()->get('player_id');

        if ($player->id != $sessionPlayerID) {
            abort(401);
        }
        // Wrong user, Unauthorized

        $request->validate([
            'score' => 'required|digits_between:0,2',
        ]);

        $score = $request->score - $game->activeHole()->par;

        $player->updateScore($game, $score);

        return [
            'score' => $score,
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Game    $game             Game instance
     * @param  Player  $player           Player instance
     * @return \Illuminate\Http\Response
     */
    public function penalise(Request $request, Game $game, Player $player)
    {
        $request->validate([
            'score' => 'required|digits_between:0,2',
        ]);

        $player->scores()->create([
            'game_id'    => $game->id,
            'hole_id'    => $game->activeHole()->id,
            'player_id'  => $player->id,
            'is_penalty' => true,
            'score'      => $request->score,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Game    $game    Game instance
     * @param  Player  $player  Player instance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game, Player $player)
    {
        if ($player->is_admin) {
            return ['error' => true];
        }

        $game->playerScores()->where(['game_id' => $game->id, 'player_id' => $player->id])->delete();

        $player->delete();

        return view('components.player-tbody', compact('game'));
        // Yeh this is lazy, use Vue
    }
}
