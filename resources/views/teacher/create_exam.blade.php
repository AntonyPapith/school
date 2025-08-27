<!-- resources/views/teacher/create_exam.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Create Exam</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-5px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.4s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-100">

<div class="max-w-5xl mx-auto p-6 bg-white rounded shadow mt-6">
    
    @if(session('success'))
        <div class="mb-4 p-4 rounded bg-green-100 border border-green-400 text-green-700 animate-fade-in">
            ✅ {{ session('success') }}
        </div>
    @endif

    <h1 class="text-2xl font-bold text-blue-700 mb-4">
        {{ $course->name }} - Exam Preparation
    </h1>

    <form method="POST" action="{{ route('teacher.exam.store') }}">
        @csrf
        <input type="hidden" name="course_id" value="{{ $course->id }}">
        
        <div class="mb-4">
            <label class="font-semibold">Exam Name</label>
            <input type="text" name="exam_name" class="w-full border p-2 rounded mt-1" placeholder="Enter exam name (e.g., Exam 1, Final Test)" required>
        </div>

        @for ($i = 0; $i < 1; $i++)
            <div class="mb-6 border p-4 rounded bg-gray-50">
                <label class="font-semibold"  >Question {{ $i+1 }}</label>
                <input type="text" name="questions[]" class="w-full border p-2 rounded mt-1" placeholder="Enter question" required>

                <div class="grid grid-cols-2 gap-4 mt-2">
                    <input type="text" name="options[{{ $i }}][a]" class="border p-2 rounded" placeholder="Option A" required>
                    <input type="text" name="options[{{ $i }}][b]" class="border p-2 rounded" placeholder="Option B" required>
                    <input type="text" name="options[{{ $i }}][c]" class="border p-2 rounded" placeholder="Option C" required>
                    <input type="text" name="options[{{ $i }}][d]" class="border p-2 rounded" placeholder="Option D" required>
                </div>

                <label class="block mt-2">Correct Answer:</label>
                <select name="correct_answers[]" class="border p-2 rounded" required>
                    <option value="">Select</option>
                    <option value="a">A</option>
                    <option value="b">B</option>
                    <option value="c">C</option>
                    <option value="d">D</option>
                </select>
            </div>
        @endfor

        <div class="flex gap-4">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Save Exam
            </button>
            <a href="{{ route('teacher.dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Cancel
            </a>
        </div>
    </form>
</div>

</body>
</html>
