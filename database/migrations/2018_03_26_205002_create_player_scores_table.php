<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_scores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('game_id');
            $table->integer('hole_id');
            $table->integer('player_id');
            $table->boolean('is_penalty');
            $table->integer('score');
            // Score, par calculated on the fly against the ref'd hole
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('player_scores');
    }
}
