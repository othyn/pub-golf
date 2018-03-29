<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Game;
use App\PlayerScore;

class Hole extends Model {

    /**
     * DOCS: Route Model Binding > Implicit Binding > Customizing The Key Name
     * Allows overriding of the default database column to use on binding instead of 'id'
     * @return string   DB column name
     */
    public function getRouteKeyName() {

        return 'uuid';
    }

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
