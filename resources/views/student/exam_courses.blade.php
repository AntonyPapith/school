<!DOCTYPE html>
<html>
<head>
    <title>My Exams</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white p-6">
    <h1 class="text-2xl font-bold mb-6">📚 My Courses - Exams</h1>

    @if($courses->isEmpty())
        <p>No courses available for exams.</p>
    @else
        <ul class="space-y-3">
            @foreach($courses as $course)
                <li>
                    <a href="{{ route('student.exam.view', $course->id) }}"
                       class="block p-4 bg-gray-800 hover:bg-gray-700 rounded-lg shadow-md transition">
                        {{ $course->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif

</body>
</html>
