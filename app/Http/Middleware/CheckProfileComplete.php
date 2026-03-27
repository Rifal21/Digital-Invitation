<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckProfileComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user && (!$user->phone || !$user->address)) {
            return redirect()->route('profile.edit')->with('warning', 'Silakan lengkapi data diri Anda (Nomor HP & Alamat) terlebih dahulu sebelum melanjutkan.');
        }

        return $next($request);
    }
}
