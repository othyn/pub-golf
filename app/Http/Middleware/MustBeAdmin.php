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
    public function handle($request, Closure $next)
    {

        // Assumes MustBeUser is run first

        $sessionPlayerID = $request->session()->get('player_id');

        if ($request->game->adminPlayer()->id != $sessionPlayerID) {
            abort(404);
        }
        // The session player isn't the admin for this game

        return $next($request);
    }
}
