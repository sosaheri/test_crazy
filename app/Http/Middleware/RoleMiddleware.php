<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {

        if (!$request->session()->has('user_id')) {
            return redirect('/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
        }

        $userId = $request->session()->get('user_id');

        $user = User::find($userId);

        if (!$user || !$user->role) {
            return redirect('/login')->with('error', 'Tu sesión no es válida o tu rol no está definido.');
        }

        $user->load('role');


        if (!in_array($user->role->name, $roles)) {
            abort(403, 'Acceso no autorizado.');
        }
        
        return $next($request);
    }
}
