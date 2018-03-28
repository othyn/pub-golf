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

        $adminPlayer = $request->game->adminPlayer();

        if (!$adminPlayer || $adminPlayer->id != $playerID)
            abort(404);
        // The session player isn't the admin for this game

        return $next($request);
    }
}
