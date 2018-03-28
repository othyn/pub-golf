<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Game;
use App\Hole;
use App\Player;

class PlayerScore extends Model {

    /**
     * Whitelist of fields to allow mass assignment
     * @var array
     */
    protected $fillable = ['game_id', 'hole_id', 'player_id', 'score']; // WARN: Careful!

    /**
     * PlayerScore relationship to Game
     * @return Collection   Parent Game for the PlayerScore
     */
    public function game() {

        return $this->belongsTo(Game::class);
    }

    /**
     * PlayerScore relationship to Hole
     * @return Collection   Parent Hole for the PlayerScore
     */
    public function hole() {

        return $this->belongsTo(Hole::class);
    }

    /**
     * PlayerScore relationship to Player
     * @return Collection   Parent Player for the PlayerScore
     */
    public function player() {

        return $this->belongsTo(Player::class);
    }
}
