<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class cekadmin
{
    public function handle(Request $request, Closure $next)
    {
        if (session('admin_role') !== 'admin') {
            return redirect()->route('home')->with('error', 'Akses ditolak');
        }

        return $next($request);
    }
}
