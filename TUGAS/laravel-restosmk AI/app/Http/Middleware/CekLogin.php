<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CekLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  mixed  ...$roles
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Jika belum login, redirect ke halaman login
        if (!Auth::check()) {
            return redirect('admin');
        }
        
        $user = Auth::user();
        
        // Periksa apakah user memiliki akses ke halaman yang diminta
        foreach ($roles as $role) {
            // Hapus whitespace yang mungkin ada
            $role = trim($role);
            if ($user->level == $role) {
                return $next($request);
            }
        }
        
        // Jika user tidak memiliki akses, tampilkan halaman error 403
        return abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}