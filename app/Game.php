<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Hole;
use App\Player;
use App\PlayerScore;

class Game extends Model {

    /**
     * Whitelist of fields to allow mass assignment
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * The "booting" method of the model.
     * @return void
     */
    public static function boot() {

        parent::boot();

        self::creating(function ($model) {
            $model->game_code = self::generateGameCode();
        });
        // Auto generate game code into game_code DB field upon create
    }

    /**
     * Generates a unique game code for the game
     * WARN - Can be DB heavy
     * @return string   Generated 7 char game code
     */
    private static function generateGameCode() {

        $gameCode = '';

        $characters = range('A', 'Z');

        $maxCharacters = count($characters) - 1;

        for ($i = 0; $i < 7; ++$i) {

            $randomIndex = mt_rand(0, $maxCharacters);

            $gameCode .= $characters[$randomIndex];
        }

        return $gameCode;
    }

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
     * Gets the active Hole
     * @return Collection   Active Hole
     */
    public function activeHole() {

        return $this->holes()->where('is_active', true)->first();
    }

    /**
     * Game relationship to Player
     * @return Collection   Players attached to the game
     */
    public function players() {

        return $this->hasMany(Player::class);
    }

    /**
     * Gets the admin Player
     * @return Collection   Admin Player
     */
    public function adminPlayer() {

        return $this->players()->where('is_admin', true)->first();
    }

    /**
     * Game relationship to PlayerScore
     * @return Collection   PlayerScores attached to the game
     */
    public function playerScores() {

        return $this->hasMany(PlayerScore::class);
    }
}
