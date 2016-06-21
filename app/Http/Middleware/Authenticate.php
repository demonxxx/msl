<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return Response::json(
                    array(
                        'accept' => -1,
                        'messages' => "Sai mã hóa, Bạn phải đăng nhập lại!",
                    ), 200
                );
            } else {
                return redirect()->guest('login');
            }
        }

        return $next($request);
    }
}
