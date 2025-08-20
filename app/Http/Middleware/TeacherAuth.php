<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class TeacherAuth
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('teacher_user') || $request->session()->get('teacher_user')->usertype !== 'teacher') {
            return redirect('/login')->with('error', 'Access denied.');
        }
        return $next($request);
    }
}
