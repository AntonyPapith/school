<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TeacherController extends Controller
{
    public function teacherDetails() {
        $teachers = DB::table('teacher_details')->get();
        return view('admin.teacher_details', compact('teachers'));
    }

    public function addTeacher() {
        return view('admin.add_teacher');
    }

    public function store(Request $request)
    {
        // Validate form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'contact' => 'required|string|max:20',
            'email' => 'required|email'
        ]);
        // Insert into database using DB facade
        DB::table('teacher_details')->insert([
            'name' => $validated['name'],
            'qualification' => $validated['qualification'],
            'contact' => $validated['contact'],
            'email' => $validated['email'],
            'status' => 'pending',
        ]);
        // Redirect or show success message
        return redirect()->route('teacher.details')->with('success', 'Teacher added successfully!');
    }

    public function edit($id) {
        $teachers = DB::table('teacher_details')->where('id', $id)->first();
        return view('admin.edit_teacher', compact('teachers'));
    }    

    public function update(Request $request, $id)
    {
        // Validate request if needed
        $request->validate([
            'name' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'contact' => 'required|string|max:15',
            'email' => 'required|email'
        ]);
        // Prepare the data
        $data = [
            'name' => $request->name,
            'qualification' => $request->qualification,
            'contact' => $request->contact,
            'email' => $request->email,
        ];
        // Update the teacher details in the database
        DB::table('teacher_details')->where('id', $id)->update($data);
        return redirect()->route('teacher.details')->with('success', 'Teacher details updated successfully!');
    }
    
    public function destroy($id) {
        DB::table('teacher_details')->where('id', $id)->delete();
        return redirect()->route('teacher.details')->with('success', 'teacher details deleted successfully!');
    }    

    public function approve($id)
    {
        DB::table('teacher_details')->where('id', $id)->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'teacher approved successfully!');
    }

    public function reject($id)
    {
        DB::table('teacher_details')->where('id', $id)->update(['status' => 'reject']);
        return redirect()->back()->with('success', 'teacher rejected.');
    }

    public function assignTeacher() {
        $teachers =DB::table('teacher_details')->where('status', 'approved')->get();
        $courses =DB::table('courses')->where('status', 'approved')->get();

        return view('admin.assign_teacher', compact('teachers', 'courses'));
    }

    public function assignCourse(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teacher_details,id',
            'course_id' => 'required|exists:courses,id',
        ]);
        // Get names from DB
        $teacher = DB::table('teacher_details')->where('id', $request->teacher_id)->first();
        $course = DB::table('courses')->where('id', $request->course_id)->first();
        DB::table('assigned_courses')->insert([
            'teacher_id' => $teacher->id,
            'teacher_name' => $teacher->name,
            'course_id' => $course->id,
            'course_name' => $course->name,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return redirect()->back()->with('success',"Course assigned successfully.");
    }

    public function teacherDashboard(Request $request)
    {
        // Get session email
        $email = Session::get('teacher_email');
        if (!$email) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }
        // 1. Check if teacher exists in teacher_details
        $teacher = DB::table('teacher_details')->where('email', $email)->first();
        // ❌ If teacher not found in teacher_details → show general dashboard
        if (!$teacher) {
            return view('teacher.general_dashboard', [
                'user' => (object)[ 'email' => $email ] // fallback object
            ]);
        }
        // ✅ Get assigned courses for this teacher
        $courses = DB::table('assigned_courses')
            ->join('courses', 'assigned_courses.course_id', '=', 'courses.id')
            ->where('assigned_courses.teacher_id', $teacher->id)
            ->select('courses.name') // removed courses.approved condition
            ->get();
    
        // ✅ Show teacher dashboard
        return view('teacher.teacher_dashboard', [
            'teacher' => $teacher,
            'courses' => $courses
        ]);
    }
    public function create()
    {
        // Example: get teacher email from session
        $teacherData = session('teacher_user');
        $teacherEmail = $teacherData->email;
        $teacherName = $teacherData->name;
        // dd($teacherEmail);
        // Get teacher record
        $teacher = DB::table('teacher')
            ->where('email', $teacherEmail)
            ->first();
        // dd($teacher->id);

        if (!$teacher) {
            return redirect()->back()->with('error', 'Teacher not found.');
        }

        // Get only this teacher's courses
        $courses = DB::table('courses')
            ->join('assigned_courses', 'courses.id', '=', 'assigned_courses.course_id')
            ->where('assigned_courses.teacher_name', $teacher->name)
            ->select('courses.id', 'courses.name')
            ->get();

        return view('teacher.add_lessons', compact('courses'));
    }

    public function storeLesson(Request $request)
    {
        // 1. Validate
        $request->validate([
            'course' => 'required|string|max:255',
            'short_description' => 'required|string',
            'today_topic' => 'required|string|max:255',
            'pdf_file' => 'nullable|mimes:pdf|max:2048',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);
        $courseId = DB::table('courses')
        ->where('name', $request->course)
        ->value('id');
        // dd($courseId);
        // 2. Handle PDF upload
        $pdfPath = null;
        if ($request->hasFile('pdf_file')) {
            // This will store in storage/app/public/lessons/pdfs
            $pdfPath = $request->file('pdf_file')->store('lessons/pdfs', 'public');
        }
        // 3. Handle Images upload
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('lessons/images', 'public');
            }
        }
        // 4. Store in DB (paths are relative to storage/public)
        DB::table('lessons')->insert([
            'course' => $request->course,
            'course_id' => $courseId,
            'short_description' => $request->short_description,
            'today_topic' => $request->today_topic,
            'pdf_path' => $pdfPath,
            'image_paths' => json_encode($imagePaths),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('add.lessons')->with('success', 'Lesson sent to students successfully.');
    }

    public function examName(){    
        $email = Session::get('teacher_email');
        if (!$email) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }
        // 1. Check if teacher exists in teacher_details
        $teacher = DB::table('teacher_details')->where('email', $email)->first();
        // Get only admin-assigned courses for this teacher
        $courses = DB::table('assigned_courses')
            ->join('courses', 'assigned_courses.course_id', '=', 'courses.id')
            ->where('assigned_courses.teacher_id', $teacher->id)
            ->select('courses.id', 'courses.name', 'courses.description')
            ->get();
    
        return view('teacher.assigned_exam_course', compact('courses'));
    }
    
    public function createExam($id)
    {
        // Fetch course name for heading
        $course = DB::table('courses')->where('id', $id)->first();
        if (!$course) {
            return redirect()->back()->with('error', 'Course not found.');
        }
        return view('teacher.create_exam', compact('course'));
    }

    public function storeExam(Request $request)
    {
        $course_id = $request->course_id;

        // Get the course name from the courses table
        $course = DB::table('courses')
        ->where('id', $course_id)
        ->value('name');

         // Exam name from input
        $exam_name = $request->exam_name;

        foreach ($request->questions as $i => $question) {
            DB::table('exam_questions')->insert([
                'course_id' => $course_id,
                'course' => $course,
                'exam_name' => $exam_name,
                'question_number' => $i + 1,
                'question' => $question,
                'option_a' => $request->options[$i]['a'],
                'option_b' => $request->options[$i]['b'],
                'option_c' => $request->options[$i]['c'],
                'option_d' => $request->options[$i]['d'],
                'correct_answer' => $request->correct_answers[$i],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('teacher.dashboard')->with('success', 'Exam Send successfully!');
    }

    public function viewAnswerSheet()
    {
        $answers = DB::table('exam_answers')
            ->join('student', 'exam_answers.student_email', '=', 'student.email')
            ->join('courses', 'exam_answers.course_id', '=', 'courses.id')
            ->select(
                'student.name as student_name',
                'student.email as student_email',
                'courses.name as course_name',
                'exam_answers.exam_name',
                'courses.id as course_id',
                'exam_answers.question_number',  
                'exam_answers.question_text as question',
                'exam_answers.selected_option as answer',
                'exam_answers.mark'
            )
            ->orderBy('courses.id')
            ->orderBy('student.name')
            ->get();

        return view('teacher.answer_sheet', compact('answers'));
    }

    public function saveMarks(Request $request, $student_email, $course_id)
    {
        $marks = $request->input('marks');
    
        if (!$marks || !is_array($marks)) {
            return response()->json(['success' => false, 'message' => 'Invalid data']);
        }
    
        foreach ($marks as $markEntry) {
            $questionNumber = $markEntry['question_number'];
            $mark = $markEntry['mark'];
    
            // If record exists, update. If not, insert a new one.
            $existing = DB::table('exam_answers')
                ->where('student_email', $student_email)
                ->where('course_id', $course_id)
                ->where('question_number', $questionNumber)
                ->first();
    
            if ($existing) {
                DB::table('exam_answers')
                    ->where('student_email', $student_email)
                    ->where('course_id', $course_id)
                    ->where('question_number', $questionNumber)
                    ->update(['mark' => $mark, 'updated_at' => now()]);
            } else {
                DB::table('exam_answers')->insert([
                    'student_email' => $student_email,
                    'course_id' => $course_id,
                    'question_number' => $questionNumber,
                    'mark' => $mark,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    
        return response()->json(['success' => true, 'message' => 'Marks saved successfully']);
    }
    
}
