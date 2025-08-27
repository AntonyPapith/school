<!DOCTYPE html>
<html>
<head>
    <title>{{ $course->name }} - Exams</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .brand-color {
            background-color: #1e293b; /* Dark slate blue */
        }
    </style> 
</head>
<body class="bg-gray-100 min-h-screen flex">
    
    <!-- Sidebar -->
    @include('includes.student_sidebar')

    <!-- Right Content -->
    <div class="flex-1 flex flex-col p-8 overflow-hidden">
        <!-- Heading -->
        <h1 class="text-3xl font-bold mb-6 text-blue-800 underline">
            📘 {{ $course->name }} - Exams
        </h1>

        @if($exams->isEmpty())
            <p class="text-red-500 text-lg">❌ No exams available for this course.</p>
        @else
            <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($exams as $exam)
                    <li>
                        <a href="{{ route('student.exam.questions', $exam->course_id) }}"
                           class="block p-6 bg-white hover:bg-indigo-50 rounded-xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1">
                            <span class="text-indigo-700 font-semibold text-lg">📝 {{ $exam->exam_name }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</body>
</html>
