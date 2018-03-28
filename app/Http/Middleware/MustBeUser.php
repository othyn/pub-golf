<?php

namespace App\Http\Middleware;

use Closure;

class MustBeUser {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        if (!$request->session()->has('player_id'))
            return redirect('/');
        // User doesn't have a player in the session yet

        $playerID = $request->session()->get('player_id');

        if (!$request->game->players()->where('id', $playerID)->exists())
            return redirect('/');
        // The session player isn't on this game

        if (!$request->game->has('holes')->exists() && $request->segment(2) != 'edit') {

            $request->session()->flash('message.warning', 'Too fast! This game is still being setup. You\'ll need to get your fun coordinator to setup at least 1 hole before you can play 😜');

            return redirect('/');
        }
        // The game doesn't have any holes yet!

        return $next($request);
    }
}
