<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserPermission
{
    public function handle($request, Closure $next, $permission)
    {
        $user = Auth::user();

        if (!$user || !$user->hasPermission($permission)) {
            // Erişim yetkisi olmayanlar için özel bir yanıt döndür
            return response()->view('errors.no-access', ['message' => 'Erişim yetkiniz yok. Ana sayfaya yönlendiriliyorsunuz.'], 403);
        }

        return $next($request);
    }
}
