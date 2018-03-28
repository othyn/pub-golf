<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Uuid;

use App\Game;
use App\PlayerScore;

class Player extends Model {

    /**
     * Whitelist of fields to allow mass assignment
     * @var array
     */
    protected $fillable = ['name', 'is_admin']; // WARN: Careful!

    /**
     * The "booting" method of the model.
     * @return void
     */
    public static function boot() {

        parent::boot();

        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
        // Auto generate UUID into uuid DB field upon create
    }

    /**
     * DOCS: Route Model Binding > Implicit Binding > Customizing The Key Name
     * Allows overriding of the default database column to use on binding instead of 'id'
     * @return string   DB column name
     */
    public function getRouteKeyName() {

        return 'uuid';
    }

    /**
     * Player relationship to Game
     * @return Collection   Parent Game for the Player
     */
    public function game() {

        return $this->belongsTo(Game::class);
    }

    /**
     * Player relationship to PlayerScore
     * @return Collection   PlayerScores attached to the Player
     */
    public function scores() {

        return $this->hasMany(PlayerScore::class);
    }

    /**
     * Updates (or creates) the score for a player
     * @return void
     */
    public function updateScore($game, $score) {

        return $this->scores()->updateOrCreate(
            ['game_id' => $game->id, 'hole_id' => $game->activeHole()->id, 'player_id' => $this->id],
            ['score' => $score]
        );
    }
}
