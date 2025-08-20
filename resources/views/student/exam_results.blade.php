{{-- <!DOCTYPE html>
<html>
<head>
    <title>Exam Results</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <h1 class="text-2xl font-bold mb-4">Exam Results for {{ $student->name }}</h1>
    <table class="table-auto border-collapse border border-gray-400 w-full">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Question No</th>
                <th class="border px-4 py-2">Question</th>
                <th class="border px-4 py-2">Your Answer</th>
                <th class="border px-4 py-2">Marks Awarded</th>
            </tr>
        </thead>
        <tbody>
            @forelse($answers as $answer)
                <tr>
                    <td class="border px-4 py-2">{{ $answer->question_number }}</td>
                    <td class="border px-4 py-2">{{ $answer->question_text }}</td>
                    <td class="border px-4 py-2">{{ $answer->selected_option }}</td>
                    <td class="border px-4 py-2">{{ $answer->mark ?? 0 }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4">No answers found for this exam.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4 font-bold text-xl">
        Total Marks: {{ $totalMarks }} / {{ $maxMarks }}
    </div>

    <div class="mt-2 text-lg text-blue-600 font-semibold">
        {{ $resultMessage }}
    </div>

</body>
</html> --}}

<!DOCTYPE html>
<html>
<head>
    <title>My Exam Results</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-6 bg-gray-100">

<h1 class="text-2xl font-bold mb-4">Exam Results for {{ $student->name }}</h1>

@if($results->isEmpty())
    <p class="text-gray-600">No results available yet.</p>
@else
    <p class="mb-4 text-lg">
        Course: <span class="font-semibold">{{ $results[0]->course_name }}</span>
    </p>
    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="border p-2">Q. No</th>
                <th class="border p-2">Question</th>
                <th class="border p-2">Your Answer</th>
                <th class="border p-2">Mark</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $res)
                <tr>
                    <td class="border p-2">{{ $res->question_number }}</td>
                    <td class="border p-2">{{ $res->question }}</td>
                    <td class="border p-2">{{ $res->answer }}</td>
                    <td class="border p-2">{{ $res->mark }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4 font-bold text-xl">
        Total Marks: {{ $totalMarks }} / {{ $maxMarks }}
    </div>

    <div class="flex items-center justify-center space-x-4 mt-6">
    <div class="mt-2 text-lg text-blue-600 font-semibold">
         {{ $resultMessage }}
    </div>
    <a href="{{ route('student.dashboard') }}" 
        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow"> 
          OK
     </a>
    </div>
@endif
</body>
</html>

