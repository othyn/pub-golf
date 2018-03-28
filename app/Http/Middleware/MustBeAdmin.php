<?php

namespace App\Http\Middleware;

use Closure;

class MustBeAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        // Assumes MustBeUser is run first

        $playerID = $request->session()->get('player_id');

        if (!$request->game->where('admin_player_id', $playerID)->exists())
            return redirect('/');
        // The session player isn't the admin for this game

        return $next($request);
    }
}
