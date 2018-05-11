<?php

namespace App;

use Uuid;
use Illuminate\Database\Eloquent\Model;

class Hole extends Model
{
    /**
     * Whitelist of fields to allow mass assignment.
     * @var array
     */
    protected $fillable = ['location', 'drink', 'par', 'is_active']; // WARN: Careful!

    /**
     * The "booting" method of the model.
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
        // Auto generate UUID into uuid DB field upon create
    }

    /**
     * DOCS: Route Model Binding > Implicit Binding > Customizing The Key Name
     * Allows overriding of the default database column to use on binding instead of 'id'.
     * @return string   DB column name
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     * Hole relationship to Game.
     * @return Collection   Parent Game for the Hole
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * Hole relationship to PlayerScore.
     * @return Collection   PlayerScores attached to the Hole
     */
    public function scores()
    {
        return $this->hasMany(PlayerScore::class);
    }
}
