<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    public function studentDetails() {
        $students = DB::table('student_details')->get();
        return view('admin.student_details', compact('students'));
    }

    public function addStudent() {
        // $courses = Course::where('status', 'approved')->get();
        $courses = DB::table('courses')->where('status', 'approved')->get();
        return view('admin.add_student',compact('courses'));
    }

    public function store(Request $request)
    {
        // Validate form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'contact' => 'required|string|max:20',
            'email' => 'required|string|max:20',
        ]);
        // Insert into database
        DB::table('student_details')->insert([
            'name' => $validated['name'],
            'course' => $validated['course'],
            'dob' => $validated['dob'],
            'gender' => $validated['gender'],
            'contact' => $validated['contact'],
            'email' => $validated['email'],
            'status' => 'pending',
        ]);
        return redirect()->route('student.details')->with('success', 'Student added successfully!');
    }

    public function edit($id) {
        $student = DB::table('student_details')->where('id', $id)->first();
        return view('admin.edit_student', compact('student'));
    }    

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'contact' => 'required|string|max:20',
        ]);
    
        $data = [
            'name' => $request->name,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'contact' => $request->contact,
        ]; 
        DB::table('student_details')->where('id', $id)->update($data);
    
        return redirect()->route('student.details')->with('success', 'Student details updated successfully!');
    }    

    public function destroy($id) {
        DB::table('student_details')->where('id', $id)->delete();
        return redirect()->route('student.details')->with('success', 'Student details deleted successfully!');
    }    

    public function approve($id)
    {
        DB::table('student_details')->where('id', $id)->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Student approved successfully!');
    }

    public function reject($id)
    {
        DB::table('student_details')->where('id', $id)->update(['status' => 'reject']);
        return redirect()->back()->with('success', 'Student rejected.');
    }

    public function studentDashboard()
    {
        // Here 'student_user' is the whole student object
        $studentSession = session('student_user');
        if (!$studentSession) {
            return redirect()->route('login')->with('error', 'Session expired. Please log in again.');
        }
        // Email comes from session object
        $studentEmail = $studentSession->email;
        // Fetch student login info
        $student = DB::table('student')->where('email', $studentEmail)->first();
        if (!$student) {
            return redirect()->route('login')->with('error', 'Student not found.');
        }

        // Fetch student details info
        $studentDetails = DB::table('student_details')->where('email', $studentEmail)->first();
        $student->course = $studentDetails ? $studentDetails->course : 'No course assigned';

        // Let's say you have student course from student details
        $studentCourseName = $student->course;

        // Find the teacher name assigned to this course
        $teacherName = DB::table('assigned_courses')
            ->where('course_name', $studentCourseName)
            ->value('teacher_name');
            
        // Fetch lessons for the course
        $lessons = DB::table('lessons')
                    ->where('course', $student->course)
                    ->get();

        return view('student.student_dashboard', compact('student', 'lessons','teacherName'));
    }

    public function examCourses()
    {
        // Get logged-in student's ID from session object
        $student = session('student_user');
        
        if (!$student) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }
        $studentId = $student->email; // ✅ Extract just the ID
        // Get the student's selected course IDs from student_details
        $studentCourseIds = DB::table('student_details')
            ->where('email', $studentId) // make sure column name matches
            ->pluck('course');
            // dd($studentCourseIds);
        $courses = DB::table('courses')
            ->whereIn('name', $studentCourseIds)
            ->get();

        return view('student.exam_courses', compact('courses'));
    }

    public function viewExam($course_id)
    {
        // Get course name
        $course = DB::table('courses')->where('id', $course_id)->first();
        if (!$course) {
            return redirect()->route('student.exam.courses')->with('error', 'Course not found.');
        }
        // Get all exam questions for this course
        $questions = DB::table('exam_questions')
            ->where('course_id', $course_id)
            ->get();

        return view('student.exam_view', compact('course', 'questions'));
    }

    public function submitExam(Request $request, $course_id)
    {
        $student = session('student_user');
        if (!$student) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        $studentName = $student->name;
        $studentEmail = $student->email;

        // Get course name
        $courseName = DB::table('courses')->where('id', $course_id)->value('name');

        // Loop through submitted answers
        foreach ($request->answers as $questionNumber => $selectedOption) {
            // Fetch question text by course_id and question_number
            $question = DB::table('exam_questions')
                ->where('course_id', $course_id)
                ->where('question_number', $questionNumber)
                ->first();
                    if ($question) {
            // Map letters to option texts
            $optionMap = [
                'a' => $question->option_a,
                'b' => $question->option_b,
                'c' => $question->option_c,
                'd' => $question->option_d,
            ];

            // Get the full option text corresponding to the selected letter
            $selectedOptionText = $optionMap[$selectedOption] ?? $selectedOption;

            DB::table('exam_answers')->insert([
                'student_name'    => $studentName,
                'student_email'   => $studentEmail,
                'course_id'       => $course_id,
                'course_name'     => $courseName,
                'question_number' => $questionNumber,
                'question_text'   => $question->question,
                'selected_option' => $selectedOptionText,
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);
            }
        }

        return redirect()->route('student.dashboard')->with('success', 'Exam submitted successfully!');
    }

    public function examResults()
{
    // Assuming you stored the student email in session when they logged in
    $studentData = session('student_user');
        $studentEmail = $studentData->email;
        $studentName = $studentData->name;

        $student = DB::table('student')->where('email', $studentEmail)->first();
        if (!$student) {
            return redirect()->back()->with('error', 'Student not found.');
        }
    // Fetch exam results
    $results = DB::table('exam_answers')
        ->join('exam_questions', 'exam_answers.question_number', '=', 'exam_questions.question_number')
        ->join('courses', 'exam_answers.course_id', '=', 'courses.id')
        ->select(
            'courses.name as course_name',
            'exam_answers.question_number',
            'exam_questions.question as question',
            'exam_answers.selected_option as answer',
            'exam_answers.mark'
        )
        ->where('exam_answers.student_email', $studentEmail)
        ->orderBy('exam_answers.question_number')
        ->get();
        // Calculate totals
        $totalMarks = $results->sum(function ($ans) {
            return $ans->mark ?? 0;
        });
        $maxMarks = count($results) * 2; // Assuming each question is 2 mark
        // Calculate percentage
        $percentage = $maxMarks > 0 ? ($totalMarks / $maxMarks) * 100 : 0;

        // Decide message based on percentage
        if ($percentage == 100) {
            $resultMessage = "🎉 Excellent! You passed with distinction!";
        } elseif ($percentage >= 80) {
            $resultMessage = "👏 Great job! You passed with a high score.";
        } elseif ($percentage >= 50) {
            $resultMessage = "🙂 You passed. Keep improving!";
        } elseif ($percentage >= 25) {
            $resultMessage = "⚠️ You need improvement.";
        } else {
            $resultMessage = "❌ Failed. Work harder and study more.";
        }
    return view('student.exam_results', compact('student','results', 'totalMarks', 'maxMarks', 'resultMessage'));
}

}