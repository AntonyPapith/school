<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My Exams</title>
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
        <h1 class="text-3xl font-bold mb-4 text-blue-800 underline">
            📚 My Courses - Exams
        </h1>

        @if($courses->isEmpty())
            <p class="text-red-500">No courses available for exams.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($courses as $course)
                    <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1">
                        <h3 class="text-xl font-semibold text-indigo-700 mb-3">{{ $course->name }}</h3>
                        <p class="text-gray-600 mb-4">Get ready for your exam.</p>

                        <a href="{{ route('student.course.exams', $course->id) }}"
                           class="inline-block px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                           📝 See Exams 
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
