{{-- <!DOCTYPE html>
<html>
<head>
    <title>{{ $course->name }} - Exam</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white p-6">

    <h1 class="text-2xl font-bold mb-6">📝 {{ $course->name }} - Exam</h1>

    @if($questions->isEmpty())
        <p>No questions have been assigned for this course yet.</p>
    @else
        <form action="{{ route('student.exam.submit', $course->id) }}" method="POST">
            @csrf
            @foreach($questions as $question)
                <div class="mb-6 p-4 bg-gray-800 rounded-lg">
                    <p class="font-semibold mb-2">{{ $question->question_number }}. {{ $question->question }}</p>
                    <div class="space-y-2">
                        <label><input type="radio" name="answers[{{ $question->question_number }}]" value="a"> {{ $question->option_a }}</label><br>
                        <label><input type="radio" name="answers[{{ $question->question_number }}]" value="b"> {{ $question->option_b }}</label><br>
                        <label><input type="radio" name="answers[{{ $question->question_number }}]" value="c"> {{ $question->option_c }}</label><br>
                        <label><input type="radio" name="answers[{{ $question->question_number }}]" value="d"> {{ $question->option_d }}</label>
                    </div>
                </div>
            @endforeach
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Submit Exam</button>
        </form>
    @endif
</body>
</html> --}}

<!DOCTYPE html>
<html>
<head>
    <title>{{ $course->name }} - Exam</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white p-6">

    <h1 class="text-2xl font-bold mb-6">📝 {{ $course->name }} - Exam</h1>

    @if($questions->isEmpty())
        <p>No questions have been assigned for this course yet.</p>
    @else

        @if(!empty($answers))
            {{-- ✅ Already submitted - show readonly answers --}}
            @foreach($questions as $question)
                <div class="mb-6 p-4 bg-gray-800 rounded-lg">
                    <p class="font-semibold mb-2">{{ $question->question_number }}. {{ $question->question }}</p>
                    <div class="space-y-2">
                        <label>
                            <input type="radio" disabled {{ ($answers[$question->question_number] ?? '') == 'a' ? 'checked' : '' }}>
                            {{ $question->option_a }}
                        </label><br>
                        <label>
                            <input type="radio" disabled {{ ($answers[$question->question_number] ?? '') == 'b' ? 'checked' : '' }}>
                            {{ $question->option_b }}
                        </label><br>
                        <label>
                            <input type="radio" disabled {{ ($answers[$question->question_number] ?? '') == 'c' ? 'checked' : '' }}>
                            {{ $question->option_c }}
                        </label><br>
                        <label>
                            <input type="radio" disabled {{ ($answers[$question->question_number] ?? '') == 'd' ? 'checked' : '' }}>
                            {{ $question->option_d }}
                        </label>
                    </div>
                </div>
            @endforeach
            <p class="text-green-400 font-semibold">✅ You have already submitted this exam.</p>

        @else
            {{-- Not submitted yet - allow attempt --}}
            <form id="examForm" action="{{ route('student.exam.submit', $course->id) }}" method="POST">
                @csrf
                @foreach($questions as $question)
                    <div class="mb-6 p-4 bg-gray-800 rounded-lg">
                        <p class="font-semibold mb-2">{{ $question->question_number }}. {{ $question->question }}</p>
                        <div class="space-y-2">
                            <label><input type="radio" name="answers[{{ $question->question_number }}]" value="a"> {{ $question->option_a }}</label><br>
                            <label><input type="radio" name="answers[{{ $question->question_number }}]" value="b"> {{ $question->option_b }}</label><br>
                            <label><input type="radio" name="answers[{{ $question->question_number }}]" value="c"> {{ $question->option_c }}</label><br>
                            <label><input type="radio" name="answers[{{ $question->question_number }}]" value="d"> {{ $question->option_d }}</label>
                        </div>
                    </div>
                @endforeach
                <button type="button" onclick="confirmSubmit()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Submit Exam</button>
            </form>
        @endif

    @endif

    <script>
        function confirmSubmit() {
            if (confirm("Are you sure you want to submit this exam? You cannot change answers later.")) {
                document.getElementById("examForm").submit();
            }
        }
    </script>

</body>
</html>


