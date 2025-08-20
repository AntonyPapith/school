<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class AdminAuth
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('admin_user') || $request->session()->get('admin_user')->usertype !== 'admin') {
            return redirect('/login')->with('error', 'Access denied.');
        }

        return $next($request);
    }
}
