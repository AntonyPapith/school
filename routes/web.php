<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('new');
// });

Route::get('/',[AdminController::class,'index'])->name('index');

Route::get('/course/register', [UserController::class, 'courseRegister'])->name('course.register');
Route::post('/course/register', [UserController::class, 'courseRegisterSave'])->name('course.register.save');

Route::get('/register', [UserController::class, 'showRegister'])->name('register');
Route::post('/register', [UserController::class, 'register']);

Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::post('/login', [UserController::class, 'login']);

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['teacher.auth'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherController::class, 'teacherDashboard'])->name('teacher.dashboard');
    Route::get('/teacher/add-lessons', [TeacherController::class, 'create'])->name('add.lessons');
    Route::post('/teacher/add-lessons', [TeacherController::class, 'storeLesson'])->name('store.lessons');

    Route::get('/teacher/exam/name', [TeacherController::class, 'examName'])->name('teacher.exam.name');
    Route::get('/teacher/exam/{course_id}', [TeacherController::class, 'createExam'])->name('teacher.exam.create');
    Route::post('/teacher/exam/store', [TeacherController::class, 'storeExam'])->name('teacher.exam.store');
    Route::get('/teacher/answer-sheet', [TeacherController::class, 'viewAnswerSheet'])->name('teacher.answer.sheet');
    Route::post('/teacher/save-marks/{student_email}/{course_id}', [TeacherController::class, 'saveMarks'])->name('teacher.saveMarks');
   
});

Route::middleware(['student.auth'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'studentDashboard'])->name('student.dashboard');

    Route::get('/student/exams', [StudentController::class, 'examCourses'])->name('student.exam.courses');
        // Step 1: View exams under a course
    Route::get('/student/course/{course}/exams', [StudentController::class, 'viewCourseExams'])->name('student.course.exams');
    // Step 2: View questions under an exam
    Route::get('/student/exam/{exam}/questions', [StudentController::class, 'viewExamQuestions'])->name('student.exam.questions');
    
    Route::post('/student/exam/{course}/submit', [StudentController::class, 'submitExam'])->name('student.exam.submit');

    Route::get('/student/results', [StudentController::class, 'examResults'])->name('student.exam.results');

// Route::get('/student/exam/{course}', [StudentController::class, 'viewExam'])->name('student.exam.view');


});

Route::middleware(['admin.auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/courses/add', [AdminController::class, 'AddCourse'])->name('admin.courses.add');
    Route::post('/admin/courses/save', [AdminController::class, 'saveCourse'])->name('admin.courses.save');
    Route::get('/admin/courses/{id}/edit', [AdminController::class, 'edit'])->name('admin.courses.edit');
    Route::put('/admin/courses/{id}', [AdminController::class, 'update'])->name('admin.courses.update');
    Route::delete('/admin/courses/{id}', [AdminController::class, 'destroy'])->name('admin.courses.destroy');
    Route::post('/admin/courses/{id}/approve', [AdminController::class, 'approve'])->name('admin.courses.approve');
    Route::post('/admin/courses/{id}/reject', [AdminController::class, 'reject'])->name('admin.courses.reject');


    Route::get('teacher/details',[TeacherController::class,'teacherDetails'])->name('teacher.details');
    Route::get('teacher/details/add',[TeacherController::class,'addTeacher'])->name('teacher.details.add');
    Route::post('/teacher/store', [TeacherController::class, 'store'])->name('teacher.add.store');
    Route::get('/teacher/{id}/edit', [TeacherController::class, 'edit'])->name('teacher.details.edit');
    Route::put('/teacher/{id}/update', [TeacherController::class, 'update'])->name('teacher.details.update');
    Route::delete('/teacher/details/{id}', [TeacherController::class, 'destroy'])->name('teacher.details.destroy');
    Route::post('/teacher/{id}/approve', [TeacherController::class, 'approve'])->name('teacher.approve');
    Route::post('/teacher/{id}/reject', [TeacherController::class, 'reject'])->name('teacher.reject');


    Route::get('student/details',[StudentController::class,'studentDetails'])->name('student.details');
    Route::get('student/details/add',[StudentController::class,'addStudent'])->name('student.details.add');
    Route::post('/student/store', [StudentController::class, 'store'])->name('student.add.store');
    Route::get('/student/{id}/edit', [StudentController::class, 'edit'])->name('student.details.edit');
    Route::put('/student/{id}/update', [StudentController::class, 'update'])->name('student.details.update');
    Route::delete('/student/details/{id}', [StudentController::class, 'destroy'])->name('student.details.destroy');
    Route::post('/student/{id}/approve', [StudentController::class, 'approve'])->name('student.approve');
    Route::post('/student/{id}/reject', [StudentController::class, 'reject'])->name('student.reject');
    

    Route::get('assigned/teacher',[TeacherController::class,'assignTeacher'])->name('assign.teacher');
    Route::post('/assign-course', [TeacherController::class, 'assignCourse'])->name('assign.course');

    Route::get('offerd/course',[AdminController::class,'offerCourse'])->name('offer.course');
    Route::get('offerd/course/add', [AdminController::class, 'offerCourseAdd'])->name('add.offer.course');
    Route::post('/offerd/course/save', [AdminController::class, 'offerCourseSave'])->name('offer.courses.save');
    Route::get('/offerd/course/{id}/edit', [AdminController::class, 'offerCourseEdit'])->name('offer.courses.edit');
    Route::put('/offerd/course/{id}', [AdminController::class, 'offerCourseUpdate'])->name('offer.courses.update');
    Route::delete('/offerd/course/{id}', [AdminController::class, 'destroyOffer'])->name('offer.courses.destroy');
    Route::post('/offerd/course/{id}/approve', [AdminController::class, 'approveOffer'])->name('offer.courses.approve');
    Route::post('/offerd/course/{id}/reject', [AdminController::class, 'rejectOffer'])->name('offer.courses.reject');
});