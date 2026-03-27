<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPackagePurchase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user has at least one confirmed paid transaction
        $hasPaidPackage = Auth::user()->transactions()
            ->where('status', 'paid')
            ->exists();

        if (!$hasPaidPackage) {
            return redirect()->route('packages.index')
                ->with('warning', 'Silakan pilih dan selesaikan pembayaran paket terlebih dahulu untuk mulai membuat undangan Anda.');
        }

        return $next($request);
    }
}
