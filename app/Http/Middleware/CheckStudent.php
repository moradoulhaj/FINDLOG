<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckStudent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Vérifie si l'utilisateur est authentifié et est un étudiant
        if (auth()->check() && auth()->user()->usertype === 'student') {
            return $next($request);
        }

        // Si l'utilisateur n'est pas authentifié ou n'est pas un étudiant, renvoie une réponse interdite (403)
        abort(403, 'Unauthorized action.');
    }
}

