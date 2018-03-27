<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Game;
use App\PlayerScore;

class Hole extends Model {

    /**
     * Hole relationship to Game
     * @return Collection   Parent Game for the Hole
     */
    public function game() {

        return $this->belongsTo(Game::class);
    }

    /**
     * Hole relationship to PlayerScore
     * @return Collection   PlayerScores attached to the Hole
     */
    public function scores() {

        return $this->hasMany(PlayerScore::class);
    }
}
