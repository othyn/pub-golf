<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Hole;
use App\Player;
use App\PlayerScore;

class Game extends Model {

    /**
     * DOCS: Route Model Binding > Implicit Binding > Customizing The Key Name
     * Allows overriding of the default database column to use on binding instead of 'id'
     * @return string   DB column name
     */
    public function getRouteKeyName() {

        return 'game_code';
    }

    /**
     * Game relationship to Hole
     * @return Collection   Holes attached to the game
     */
    public function holes() {

        return $this->hasMany(Hole::class);
    }

    /**
     * Game relationship to Player
     * @return Collection   Players attached to the game
     */
    public function players() {

        return $this->hasMany(Player::class);
    }

    /**
     * Game relationship to PlayerScore
     * @return Collection   PlayerScores attached to the game
     */
    public function playerScores() {

        return $this->hasMany(PlayerScore::class);
    }

    /**
     * Add a player to a game
     * @param string $name player name
     */
    public function addPlayer($name) {

        $this->players()->create(compact('name'));
    }
}
