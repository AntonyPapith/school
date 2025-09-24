<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdn.tailwindcss.com"></script>
<title>Student Video Call</title>
<script src="https://js.pusher.com/8.2/pusher.min.js"></script>
<script>
Pusher.logToConsole = true;
const pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
    cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
    forceTLS: true
});
</script>
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-6">
    <h1 class="text-4xl font-bold mb-6 text-blue-800 text-center underline">Video Call</h1>

    @if($teachers->isEmpty())
        <p class="text-center text-gray-600 text-lg">No teachers found for your course.</p>
    @else
        <h2 class="text-2xl font-bold text-blue-700 mb-4">Available Teachers</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($teachers as $teacher)
            <div class="bg-white p-5 shadow-lg rounded-lg border-l-4 border-blue-500 hover:shadow-xl transition">
                <h3 class="text-2xl font-semibold text-blue-800">{{ $teacher->name }}</h3>
                <p class="text-gray-700 mt-1"><span class="font-semibold">Course:</span> {{ $teacher->course_name }}</p>
                <p class="text-gray-700"><span class="font-semibold">Email:</span> {{ $teacher->email }}</p>
                <p class="text-gray-700 mt-2 text-sm text-gray-500">Waiting for call from teacher...</p>
            </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Incoming Call Notification -->
<div id="incomingCall" class="fixed inset-0 bg-black bg-opacity-70 hidden z-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-xl text-center w-96">
        <h2 class="text-2xl font-bold mb-4">📞 Incoming Call</h2>
        <p id="callerName" class="text-lg text-gray-700 mb-6"></p>
        <div class="flex justify-center gap-4">
            <button id="acceptCall" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded font-semibold">✅ Accept</button>
            <button id="rejectCall" class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded font-semibold">❌ Reject</button>
        </div>
    </div>
</div>

<script>
// Subscribe to student Pusher channel
const studentId = {{ session('student_user')->id }};
const channelStudent = pusher.subscribe('student-' + studentId);

// Listen for teacher call requests
channelStudent.bind('App\\Events\\VideoCallRequest', function(data) {
    document.getElementById('incomingCall').style.display = 'flex';
    document.getElementById('callerName').textContent = "Teacher " + data.teacher_name + " is calling you";

    // Accept call
    document.getElementById('acceptCall').onclick = () => {
        fetch(`/video-call/${data.call_id}/accept`, { 
            method: 'POST', 
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } 
        })
        .then(() => {
            alert("✅ Call accepted. Starting video...");
        });

        document.getElementById('incomingCall').style.display = 'none';
    };

    // Reject call
    document.getElementById('rejectCall').onclick = () => {
        fetch(`/video-call/${data.call_id}/reject`, { 
            method: 'POST', 
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } 
        })
        .then(() => {
            alert("❌ Call rejected.");
        });

        document.getElementById('incomingCall').style.display = 'none';
    };
});
</script>

</body>
</html>
