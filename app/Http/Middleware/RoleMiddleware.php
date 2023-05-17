<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response {
        $user = Auth::user();
        
        $roleMap = [
            'admin' => Role::ADMIN,
            'user' => Role::USER,
        ];
    
        $requiredRoleId = $roleMap['admin'];

        if(!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        if($request->user()->role_id !== $requiredRoleId) {
            abort(403, 'Unauthorized');
        }
        return $next($request);
    }
}
