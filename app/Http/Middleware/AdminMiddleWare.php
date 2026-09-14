<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * 
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var \App\Models\Client|null $user */
            $user = Auth::user();
        if ($user && $user->isAdmin()) {
        return $next($request);
    }

        abort(403, 'You do not have administrator access.');
        
    }



}
