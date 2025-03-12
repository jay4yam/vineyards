<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //si la requete est en GET
        if ($request->method() === 'GET') {

            //récupère le premier segment de l'url
            $segment = $request->segment(1);

            //si le segment est dans le tableau available_locales
            if (!in_array($segment, config('app.available_locales'))) {

                //récupère les autres segments de l'url
                $segments = $request->segments();

                $fallback = session('locale') ?: config('app.fallback_locale');

                $newSegments = array_replace($segments, [0 => $fallback]);

                return redirect()->to( implode('/', $newSegments) );
            }

            session(['locale' => $segment]);

            app()->setLocale($segment);
        }

        return $next($request);
    }
}
