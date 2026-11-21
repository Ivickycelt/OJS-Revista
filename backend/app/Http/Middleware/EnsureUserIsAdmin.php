<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Solo deja pasar a usuarios con rol 'admin'.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $usuario = $request->user();

        if (! $usuario || ! $usuario->isAdmin()) {
            return response()->json(['message' => 'No tienes permiso para esta acción.'], 403);
        }

        return $next($request);
    }
}
