<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Pengujian
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
        $credentials = [
            'email' => 'ry.prg75@gmail.com',
            'password' => 'perawatgigi'
        ];

        Auth::attempt($credentials);

        return $next($request);
    }
}
