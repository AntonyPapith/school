<!DOCTYPE html>
<html>
<head>
    <title>My Exam Results</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-8 bg-gradient-to-br from-gray-100 via-blue-50 to-gray-100 min-h-screen">

    <div class="max-w-6xl mx-auto bg-white shadow-2xl rounded-2xl p-8 border border-gray-200">
        <h1 class="text-4xl font-extrabold mb-10 text-center text-blue-700 drop-shadow">
            📑 Exam Results for {{ $student->name }}
        </h1>

        @forelse($examSummaries as $examName => $exam)
            <div class="mb-12 p-6 rounded-xl bg-gradient-to-r from-white to-blue-50 shadow-inner border border-gray-200">
                
                <!-- Exam Title -->
                <h2 class="text-2xl font-bold text-blue-600 mb-4 text-center">
                    📝 {{ $examName }}
                </h2>

                <!-- Course Info -->
                <p class="mb-6 text-lg text-center text-gray-700">
                    Course: <span class="font-semibold text-gray-900">{{ $exam['results'][0]->course_name }}</span>
                </p>

                <!-- Results Table -->
                <div class="overflow-x-auto rounded-lg shadow-md">
                    <table class="table-auto w-full border-collapse border border-gray-300 text-center">
                        <thead class="bg-blue-100 text-blue-900">
                            <tr>
                                <th class="border p-3">Q. No</th>
                                <th class="border p-3 text-left">Question</th>
                                <th class="border p-3 text-left">Your Answer</th>
                                <th class="border p-3">Mark</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($exam['results'] as $res)
                                <tr class="hover:bg-blue-50 transition">
                                    <td class="border p-3 font-medium">{{ $res->question_number }}</td>
                                    <td class="border p-3 text-left">{{ $res->question }}</td>
                                    <td class="border p-3 text-left">
                                        {{ $res->answer ?? '❌ Not Answered' }}
                                    </td>
                                    <td class="border p-3 font-semibold">
                                        @if($res->mark !== null)
                                            ✅ {{ $res->mark }}
                                        @else
                                            ⏳ Pending
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Totals + Result Message -->
                <div class="mt-8 text-center">
                    <div class="font-bold text-xl text-gray-900">
                        Total Marks: <span class="text-blue-600">{{ $exam['totalMarks'] }}</span> / {{ $exam['maxMarks'] }}
                    </div>

                    {{-- ✅ Show message only if not all pending --}}
                    @if(!$exam['allPending'] && !empty($exam['resultMessage']))
                        <div class="mt-4 text-lg font-semibold px-4 py-2 inline-block rounded-lg shadow-md
                            @if(str_contains($exam['resultMessage'], 'Excellent')) bg-green-100 text-green-700
                            @elseif(str_contains($exam['resultMessage'], 'Great')) bg-emerald-100 text-emerald-700
                            @elseif(str_contains($exam['resultMessage'], 'passed')) bg-blue-100 text-blue-700
                            @elseif(str_contains($exam['resultMessage'], 'improvement')) bg-yellow-100 text-yellow-700
                            @elseif(str_contains($exam['resultMessage'], 'Failed')) bg-red-100 text-red-700
                            @else bg-gray-100 text-gray-700 @endif">
                            {{ $exam['resultMessage'] }}
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-gray-600 text-center text-lg">No results available yet.</p>
        @endforelse

        <!-- OK Button -->
        <div class="text-center mt-10">
            <a href="{{ route('student.dashboard') }}" 
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl shadow-lg transition">
                ✅ OK
            </a>
        </div>
    </div>

</body>
</html>
