<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAccountAccess
{
    public function handle(
        Request $request,
        Closure $next,
        ?string $role = null
    ): Response {
        $user = $request->user();

        // Block unauthenticated users.
        if (! $user) {
            return redirect()->route('login');
        }

        // Block inactive accounts, including existing sessions.
        if (! $user->is_active) {
            abort(403, 'Your account has been deactivated.');
        }

        // Only Admin and LPU accounts may access the system.
        if (! in_array($user->role, ['admin', 'lpu'], true)) {
            abort(403, 'Invalid user role.');
        }

        // Restrict pages based on the required role.
        if ($role !== null && $user->role !== $role) {
            abort(403, 'You are not authorised to access this page.');
        }

        return $next($request);
    }
}
