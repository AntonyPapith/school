<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Exam Courses</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .brand-color {
            background-color: #1e293b; /* Dark slate blue */
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex">
    @include('includes.success_message')
    <!-- Sidebar -->
    @include('includes.teachers_sidebar')

    <!-- Right Content -->
    <div class="flex-1 p-8">

        <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
            <h2 class="text-2xl font-bold text-blue-800 mb-4">Select a Course for Exam Preparation</h2>

            @if($courses->isEmpty())
                <p class="text-gray-500">No courses assigned by admin yet.</p>
            @else
                <ul class="space-y-3">
                    @foreach($courses as $course)
                    <a href="{{ route('teacher.exam.create', $course->id) }}" 
                       class="block border p-4 rounded-lg bg-white hover:bg-blue-100 
                              transition-all duration-300 ease-in-out 
                              hover:shadow-lg transform hover:scale-[1.02] active:scale-[0.98]">
                        <div class="text-blue-600 font-semibold text-lg flex items-center">
                            <span class="text-xl mr-2">📘</span> <!-- Small icon size -->
                            {{ $course->name }}
                            {{-- <span class="text-gray-400 text-2xl group-hover:text-blue-600 transition-colors duration-300">
                                ➡
                            </span> --}}
                        </div>
                        
                        {{-- <p class="text-gray-600 text-sm mt-1">{{ $course->description }}</p> --}}
                    </a>
                    @endforeach
                </ul>
            @endif
        </div>

    </div>

</body>
</html>
