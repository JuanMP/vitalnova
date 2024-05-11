<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsDoctor
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
        //Verifica si el usuario actual está autenticado y es un administrador
        if (auth()->check() && auth()->user()->isDoctor()) {
            return $next($request);
        }

        //Si el usuario no es un administrador, puedes redirigirlo a alguna página o mostrar un mensaje de error.
        //En este caso, se está redirigiendo a la página anterior.
        return redirect()->back()->with('error', 'Acceso no autorizado.');
    }
}
