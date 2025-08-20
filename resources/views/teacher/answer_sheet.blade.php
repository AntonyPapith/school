<!DOCTYPE html>
<html>
<head>
    <title>Submitted Answers</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Fix Mark button bottom right */
        #markButtonContainer {
            display: flex;
            justify-content: flex-end;
            margin-top: 0.75rem;
        }
    </style>
</head>
<body class="bg-gray-100 p-6">

    <h1 class="text-2xl font-bold mb-1">Exam Submitted By:</h1>
    <p class="mb-4 text-lg">
        <strong>Student:</strong> {{ $answers->first()->student_name ?? 'N/A' }} <br>
        <strong>Course:</strong> {{ $answers->first()->course_name ?? 'N/A' }}
    </p>

    @if($answers->isNotEmpty())
        <!-- show form -->
        <form id="gradingForm">
            <table class="table-auto border-collapse border border-gray-400 w-full">
                <thead>
                    <tr class="bg-gray-200">
                        <!-- Removed Student Name and Course Name headers -->
                        <th class="border px-4 py-2">Question No</th>
                        <th class="border px-4 py-2">Question</th>
                        <th class="border px-4 py-2">Answer</th>
                        <th class="border px-4 py-2">Mark as</th>
                        <th class="border px-4 py-2">Mark</th> <!-- New column for marks -->
                    </tr>
                </thead>
                <tbody>
                    @forelse($answers as $index => $answer)
                        <tr>
                            <!-- Removed Student Name and Course Name cells -->
                            <td class="border px-4 py-2">{{ $answer->question_number }}</td>
                            <td class="border px-4 py-2">{{ $answer->question }}</td>
                            <td class="border px-4 py-2">{{ $answer->answer }}</td>
                            <td class="border px-4 py-2">
                                <label>
                                    <input type="radio" name="mark_{{ $index }}" value="right" required>
                                    Right
                                </label>
                                <label class="ml-4">
                                    <input type="radio" name="mark_{{ $index }}" value="wrong" required>
                                    Wrong
                                </label>
                            </td>
                            <td class="border px-4 py-2 mark-cell"></td> <!-- Mark output -->
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">No answers submitted yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div id="markButtonContainer">
                <button type="button" onclick="calculateMarks()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 m-2 rounded">
                    Mark
                </button>
                
                <button type="button" id="saveBtn" onclick="saveMarks()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 m-2 rounded" disabled>
                    Save
                </button>
            </div>
        </form>
    @else
        <p class="text-red-500">No answers submitted yet.</p>
    @endif

    <div id="totalMarks" class="mt-4 font-bold text-xl"></div>

    {{-- @php
        $firstAnswer = $answers->first();
        $studentEmail = $firstAnswer->student_email ?? '';
        $courseId = $firstAnswer->course_id ?? '';
    @endphp --}}

    {{-- @php
        $firstAnswer = $answers->first();
        dd($firstAnswer);
        $studentEmail = $firstAnswer ? $firstAnswer->student_email : '';
        $courseId = $firstAnswer ? $firstAnswer->course_id : '';
    @endphp --}}
    
    {{-- <script>
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
                        markGiven = 2; // 2 marks for right
                    }
                });
                if (markCells[i]) {
                    markCells[i].textContent = markGiven;
                }
                lastMarksData.push({ index: i, mark: markGiven });
            }
    
            const totalMarks = correctCount * 2;
            document.getElementById('totalMarks').innerText = `Total Marks: ${totalMarks} / ${totalQuestions * 2}`;
    
            marksCalculated = true;
            document.getElementById('saveBtn').disabled = false;
        }
    
        function saveMarks() {
            if (!marksCalculated) {
                alert('Please calculate marks first by clicking the Mark button.');
                return;
            }
    
            const totalQuestions = {{ $answers->count() }};
    
            // Build data to send (including question IDs for backend)
            const marksData = [];
    
            for(let i = 0; i < totalQuestions; i++) {
                // Assuming you have a hidden input or data attribute with the question_number or id
                // We'll use a data attribute for example here:
                const row = document.querySelectorAll('tbody tr')[i];
                const questionNumber = row.querySelector('td:nth-child(1)').innerText.trim(); // Question No column
                const mark = lastMarksData[i].mark;
    
                marksData.push({
                    question_number: questionNumber,
                    mark: mark,
                });
            }
    
            fetch('{{ route("teacher.saveMarks", ["student_email" => $answers->first()->student_email, "course_id" => $answers->first()->course_id]) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ marks: marksData }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message); // ✅ Show success message
                    window.location.href = "{{ route('teacher.dashboard') }}";
                    // alert('Marks saved successfully!');
                    // optionally disable save button or do other UI feedback
                    document.getElementById('saveBtn').disabled = true;
                } else {
                    alert('Error saving marks: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                alert('Error saving marks: ' + error.message);
            });
        }
    </script> --}}

</body>
</html>
