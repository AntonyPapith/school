<!DOCTYPE html>
<html>
<head>
    <title>Submitted Answers</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        #markButtonContainer {
            display: flex;
            justify-content: flex-end;
            margin-top: 0.75rem;
        }
    </style>
</head>
<body class="bg-gray-100 p-6">

    <h1 class="text-3xl font-extrabold text-gray-800 mb-6">📝 Answer Sheet</h1>

    <!-- Student & Exam Info Card -->
    @if($answers->isNotEmpty())
        <strong class="text-gray-900">👨‍🎓 Student:</strong> {{ $answers->first()->student_name }} <br>
        <strong class="text-gray-900">📧 Email:</strong> {{ $answers->first()->student_email }} <br>
        <strong class="text-gray-900">📚 Course:</strong> {{ $answers->first()->course_name }} <br>
        <strong class="text-gray-900">📝 Exam:</strong> {{ $answers->first()->exam_name }}
    @else
        <span class="text-red-500 font-semibold">⚠️ No student info available</span>
    @endif


    @if($answers->isNotEmpty())
        <form id="gradingForm">
            <div class="overflow-x-auto">
                <table class="table-auto border-collapse border border-gray-300 w-full text-left shadow-md rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-blue-100 text-gray-800">
                            <th class="border px-4 py-2">Q. No</th>
                            <th class="border px-4 py-2">Question</th>
                            <th class="border px-4 py-2">Answer</th>
                            <th class="border px-4 py-2">Mark As</th>
                            <th class="border px-4 py-2">Mark</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($answers as $index => $answer)
                            <tr class="hover:bg-gray-50">
                                <td class="border px-4 py-2 font-semibold text-gray-700">{{ $answer->question_number }}</td>
                                <td class="border px-4 py-2 text-gray-600">{{ $answer->question }}</td>
                                <td class="border px-4 py-2 text-gray-600">{{ $answer->answer }}</td>
                                <td class="border px-4 py-2">
                                    <label class="inline-flex items-center space-x-1">
                                        <input type="radio" name="mark_{{ $index }}" value="right" required class="text-green-600">
                                        <span>✔️ Right</span>
                                    </label>
                                    <label class="inline-flex items-center space-x-1 ml-4">
                                        <input type="radio" name="mark_{{ $index }}" value="wrong" required class="text-red-600">
                                        <span>❌ Wrong</span>
                                    </label>
                                </td>
                                <td class="border px-4 py-2 mark-cell text-center font-bold text-gray-700"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Buttons -->
            <div id="markButtonContainer" class="mt-6 space-x-3">
                <button type="button" onclick="calculateMarks()" 
                        class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg shadow-md transition">
                    ✅ Mark
                </button>
                <button type="button" id="saveBtn" onclick="saveMarks()" 
                        class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow-md transition disabled:opacity-50" 
                        disabled>
                    💾 Save
                </button>
            </div>
        </form>
    @else
        <p class="text-red-500 font-semibold text-lg">⚠️ No answers submitted yet.</p>
    @endif

    <!-- Total Marks -->
    <div id="totalMarks" class="mt-6 font-bold text-2xl text-gray-800"></div>

    <script>
        let marksCalculated = false;
        let lastMarksData = [];

        function calculateMarks() {
            const form = document.getElementById('gradingForm');
            const totalQuestions = {{ $answers->count() }};
            let correctCount = 0;
            lastMarksData = [];

            const markCells = form.querySelectorAll('.mark-cell');
            markCells.forEach(cell => cell.textContent = '');

            for(let i = 0; i < totalQuestions; i++) {
                const radios = form.querySelectorAll(`input[name="mark_${i}"]`);
                let markGiven = 0;
                radios.forEach(radio => {
                    if(radio.checked && radio.value === 'right') {
                        correctCount++;
                        markGiven = 2;
                    }
                });
                if (markCells[i]) markCells[i].textContent = markGiven;
                lastMarksData.push({ index: i, mark: markGiven });
            }

            const totalMarks = correctCount * 2;
            document.getElementById('totalMarks').innerText = `🏆 Total Marks: ${totalMarks} / ${totalQuestions * 2}`;

            marksCalculated = true;
            document.getElementById('saveBtn').disabled = false;
        }

        function saveMarks() {
            if (!marksCalculated) {
                alert('Please calculate marks first.');
                return;
            }

            const totalQuestions = {{ $answers->count() }};
            const marksData = [];

            for(let i = 0; i < totalQuestions; i++) {
                const row = document.querySelectorAll('tbody tr')[i];
                const questionNumber = row.querySelector('td:nth-child(1)').innerText.trim();
                const mark = lastMarksData[i].mark;

                marksData.push({ question_number: questionNumber, mark: mark });
            }

            @if($answers->isNotEmpty())
                fetch('{{ route("teacher.saveMarks", ["student_email" => $answers->first()->student_email, "course_id" => $answers->first()->course_id]) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ marks: marksData }),
                })
            @else
                alert("⚠️ Cannot save marks because no answers were submitted.");
            @endif

            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    window.location.href = "{{ route('teacher.dashboard') }}";
                } else {
                    alert('Error: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                alert('Error: ' + error.message);
            });
        }
    </script>
</body>
</html>
