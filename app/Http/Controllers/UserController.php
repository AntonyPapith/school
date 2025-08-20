<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function courseRegister(){
        return view('course_register');
    }

    public function courseRegisterSave(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|max:255',
            'phone'       => 'required|string|max:20',
            'prefer_mode' => 'required|string|max:50',
            'course'      => 'required|string|max:255',
            'education'   => 'required|string|max:255',
            'city'        => 'required|string|max:255',
            'age'         => 'required|integer|min:1',
        ]);

        // Insert data into your existing table using DB facade
        $details = DB::table('offer_student_register')->insert([
            'student_name'   => $request->name,
            'student_email'  => $request->email,
            'student_phone'  => $request->phone,
            'prefer_mode'    => $request->prefer_mode,
            'course_name'    => $request->course,
            'education'      => $request->education,
            'city'           => $request->city,
            'student_age'    => $request->age,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        // Redirect back with success message
        return redirect()->route('index')->with('success', '✅ Registration saved successfully!');
    }

    public function showRegister() {
        return view('register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'usertype' => 'required|in:admin,teacher,student'
        ]);
        $email = $request->email;
        $usertype = $request->usertype;
        // Check if email already exists in the respective table
        $exists = DB::table($usertype)->where('email', $email)->exists();
        if ($exists) {
            return back()->with('error', 'Email already exists for ' . $usertype . '.');
        }
        $data = [
            'name' => $request->name,
            'email' => $email,
            'password' => bcrypt($request->password)
        ];
        DB::table($usertype)->insert($data);
        return redirect()->route('login')->with('success', 'Registered successfully!');
    }    

    public function showLogin() {
        return view('login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3',
            'usertype' => 'required|in:admin,teacher,student'
        ]);
    
        if ($request->usertype === 'teacher') {
            $user = DB::table('teacher')->where('email', $request->email)->first();
            if ($user && Hash::check($request->password, $user->password)) {
                // ✅ Check if teacher is in details
                $teacherDetails = DB::table('teacher_details')
                    ->where('email', $user->email)->first();
                if ($teacherDetails) {
                    $user->usertype = 'teacher';
                    // ✅ Save both user and teacher_email if needed
                    Session::put('teacher_user', $user);
                    Session::put('teacher_email', $user->email); // this is used in dashboard
        
                    return redirect()->route('teacher.dashboard');
                } else {
                    return back()->with('error', 'Your teacher account is not approved yet.');
                }
            }
        }
        elseif ($request->usertype === 'student') {
            $user = DB::table('student')->where('email', $request->email)->first();
            if ($user && Hash::check($request->password, $user->password)) {
                $user->usertype = 'student';
                Session::put('student_user', $user);
                return redirect()->route('student.dashboard');
            }
        }
        else {
            $user = DB::table('admin')->where('email', $request->email)->first();
            if ($user && Hash::check($request->password, $user->password)) {
                $user->usertype = 'admin';
                Session::put('admin_user', $user);
                return redirect()->route('admin.dashboard');
            }
        }
        return back()->with('error', 'Invalid email or password.');
    }

    public function logout(){
        Auth::logout(); // Logs out the user
        request()->session()->invalidate();   // clear session
        request()->session()->regenerateToken(); // regenerate CSRF token
        return redirect('/login'); // Redirects to register page
    }

}
