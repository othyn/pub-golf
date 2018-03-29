<?php

namespace App\Http\Middleware;

use Closure;

class MustBeUser {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string    Check if 'play' or 'edit'
     * @return mixed
     */
    public function handle($request, Closure $next, $type) {

        if (!$request->session()->has('player_id'))
            abort(404);
        // User doesn't have a player in the session yet

        $sessionPlayerID = $request->session()->get('player_id');

        $player = $request->game->players()->where('id', $sessionPlayerID);

        if (!$player->exists())
            abort(404);
        // The session player isn't on this game

        if ($type != 'edit') {

            if (!$request->game->holes()->exists()) {

                $request->session()->flash('message.warning', 'Too fast! This game is still being setup. You\'ll need to get your fun coordinator to setup at least 1 hole before you can play 😜');

                $request->session()->flash('join.name', $player->first()->name);

                if ($request->ajax())
                    abort(304);
                else
                    return redirect("/games/{$request->game->code}/join");
            }
            // The game doesn't have any holes yet!
        }

        return $next($request);
    }
}
