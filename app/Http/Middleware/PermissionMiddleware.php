<?php

namespace App\Http\Middleware;

use Closure;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        $permissions = $this->getRequiredPermissionsRoute($request->route());
//        if ($request->user()->hasPermission($permissions) || !$permissions) {
//            return $next($request);
//        }
        $roles = $this->getRequiredRolesForRoute($request->route());
        if ($request->user()->hasRole($roles) || !$roles) {
            return $next($request);
        }
        return response([
            'error' => [
                'code'        => 'INSUFFICIENT_ROLE',
                'description' => 'You are not authorized to access this resource.'
            ]
        ], 401);
    }

    private function getRequiredPermissionsRoute($route){
        $actions = $route->getAction();
        return isset($actions['permissions']) ? $actions['permissions'] : null;
    }

    private function getRequiredRolesForRoute($route)
    {
        $actions = $route->getAction();
        return isset($actions['roles']) ? $actions['roles'] : null;
    }
}
