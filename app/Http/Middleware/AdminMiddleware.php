<?php

namespace App\Http\Middleware;

use App\Modules\Users\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        if (Auth::user() && Auth::user()->isAdmin()) {
            return $next($request);
        }
        flash('bad Credentials')->error();
        return redirect(route('admin.login'));
    }
}
