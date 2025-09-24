<?php

namespace App\Http\Controllers;

use App\Models\VideoCall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VideoCallController extends Controller
{
    // Show teacher video call page
public function teacherCalls()
{
    // Get the teacher object from session
    $teacher = session('teacher_user');

    if (!$teacher) {
        abort(403, 'Teacher not logged in.');
    }

    $teacherId = $teacher->id; // ✅ get the ID from object

    // Fetch approved students whose course matches teacher's assigned courses
    $students = DB::table('student_details')
        ->join('assigned_courses', function($join) use ($teacherId) {
            $join->on(DB::raw('TRIM(LOWER(student_details.course))'), DB::raw('TRIM(LOWER(assigned_courses.course_name))'))
                 ->where('assigned_courses.teacher_id', $teacherId);
        })
        ->where('student_details.status', 'approved')
        ->select('student_details.*')
        ->get();

    return view('teacher.video-calls', compact('students'));
}


    // Send request (Eloquent for creating call)
public function sendRequest($studentId)
{
    $call = VideoCall::create([
        'teacher_id' => Auth::id(),
        'student_id' => $studentId,
        'status'     => 'pending'
    ]);

    // broadcast event
    broadcast(new \App\Events\VideoCallRequest($call))->toOthers();

    return response()->json([
        'success' => true,
        'call_id' => $call->id
    ]);
}


// Accept request
public function acceptRequest(VideoCall $call)
{
    $call->update(['status' => 'accepted']);
    broadcast(new \App\Events\VideoCallAccepted($call))->toOthers();

    return response()->json(['success' => true]);
}

// Reject request
public function rejectRequest(VideoCall $call)
{
    $call->update(['status' => 'rejected']);
    broadcast(new \App\Events\VideoCallRejected($call))->toOthers();

    return response()->json(['success' => true]);
}


}
