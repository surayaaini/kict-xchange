<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->role_id == $this->mapRoleToId($role)) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }

    protected function mapRoleToId($role)
    {
        return match ($role) {
            'admin' => 1,
            'student' => 2,
            'staff' => 3,
            default => null,
        };
    }
}
