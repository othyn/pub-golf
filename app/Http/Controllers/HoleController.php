<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Game;
use App\Hole;

class HoleController extends Controller {

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Game    $game             Game instance
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Game $game) {

        if ($game->holes()->count() > 50)
            return ['no_more_holes' => true];
        // TODO: Fix this shit

        $request->validate([
            'location' => 'required|min:1|max:100',
            'drink'    => 'required|min:1|max:100',
            'par'      => 'required|digits_between:1,2'
        ]);

        $hole = $game->holes()->create([
            'location' => $request->location,
            'drink'    => $request->drink,
            'par'      => $request->par
        ]);

        if ($game->holes()->count() == 1) {

            $hole->is_active = true;
            $hole->save();
        }

        return view('components.hole-tbody', compact('game'));
        // Yeh this is lazy, use Vue
    }

    /**
     *
     * @param
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Game    $game             Game instance
     * @param  Hole    $hole             Hole instance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game, Hole $hole) {

        $request->validate([
            'location' => 'required|min:1|max:100',
            'drink'    => 'required|min:1|max:100',
            'par'      => 'required|digits_between:1,2'
        ]);

        $hole->update([
            'location' => $request->location,
            'drink'    => $request->drink,
            'par'      => $request->par
        ]);

        return view('components.hole-tbody', compact('game'));
        // Yeh this is lazy, use Vue
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Game    $game    Game instance
     * @param  Hole    $hole    Hole instance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game, Hole $hole) {


    }
}
