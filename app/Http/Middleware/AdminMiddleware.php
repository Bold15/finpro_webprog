<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AdminController;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Memeriksa apakah pengguna saat ini adalah admin
        if (Auth::check() && Auth::user()->isAdmin()) {
            return $next($request); // Lanjutkan request jika pengguna adalah admin
        }

        // Jika bukan admin, bisa redirect atau memberikan response lainnya
        return redirect('/home')->with('error', 'Unauthorized access.'); 
        // Anda bisa menyesuaikan respons ini sesuai dengan kebutuhan aplikasi Anda
    }
}
