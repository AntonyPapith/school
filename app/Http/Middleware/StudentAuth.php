<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class StudentAuth
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('student_user') || $request->session()->get('student_user')->usertype !== 'student') {
            return redirect('/login')->with('error', 'Access denied.');
        }
        return $next($request);
    }
}

