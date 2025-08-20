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
</html>

