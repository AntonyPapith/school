<!-- resources/views/student/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Student Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .brand-color {
            background-color: #1e293b; /* Dark slate blue */
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex">  
    @include('includes.success_message')      
    
    @include('includes.student_sidebar')
    <!-- Right Content -->
    <div class="flex-1 flex flex-col p-8 overflow-hidden">
        <!-- Heading -->
        <h1 class="text-3xl font-bold mb-4 text-blue-800 underline">
            Welcome, {{ $student->name }}
        </h1>
        <h2 class="text-2xl font-semibold text-gray-700 mb-8 bg-white shadow px-5 py-3 rounded">
            📘 Your course is: <span class="text-indigo-600">{{ $student->course }}</span>  
            <br class="md:hidden">
            <span class="text-sm text-gray-500">Sent by <span class="text-indigo-500 font-medium">{{$teacherName}}</span></span>
        </h2>
        @if($lessons->isEmpty())
            <p class="text-red-500">No lessons sent by your teacher yet.</p>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($lessons as $lesson)
                    <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1">
                        <h3 class="text-2xl font-semibold text-indigo-700 mb-2">Title: {{ $lesson->course }}</h3>
                        <p class="text-gray-600 mb-3">Description:{{ $lesson->short_description }}</p>
                        <p class="mt-2 font-medium text-gray-800">📍 Today’s Topic: <span class="text-gray-700">{{ $lesson->today_topic }}</span></p>

                        @if($lesson->pdf_path)
                            <p class="mt-3">
                                <a href="{{ asset('storage/'.$lesson->pdf_path) }}" 
                                   class="text-cyan-600 font-semibold underline hover:text-cyan-800 transition" target="_blank">
                                   📄 View PDF
                                </a>
                            </p>
                        @endif

                        @if($lesson->image_paths)
                            <div class="mt-4 flex flex-wrap gap-3">
                                @foreach(json_decode($lesson->image_paths) as $img)
                                    <img src="{{ asset('storage/'.$img) }}" 
                                         alt="Lesson Image" class="w-32 h-32 object-cover rounded-lg shadow">
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>

