<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Video Call</title>
    <!-- Load Pusher -->
    <script src="https://js.pusher.com/8.2/pusher.min.js"></script>
    <script>
        // Enable debugging
        Pusher.logToConsole = true;

        // Connect to your Pusher app
        const pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
            cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
            forceTLS: true
        });
    </script>
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-6">
    <h1 class="text-4xl font-bold mb-6 text-blue-800 text-center underline">Video Call</h1>

    @if($students->isEmpty())
        <p class="text-center text-gray-600 text-lg">No students found for your courses.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($students as $student)
            <div class="bg-white p-5 shadow-lg rounded-lg border-l-4 border-blue-500 hover:shadow-xl transition">
                <h3 class="text-2xl font-semibold text-blue-800">{{ $student->name }}</h3>
                <p class="text-gray-700 mt-1"><span class="font-semibold">Course:</span> {{ $student->course }}</p>
                <p class="text-gray-700"><span class="font-semibold">Email:</span> {{ $student->email }}</p>
                <!-- Teacher calls student -->
                <button class="call-btn bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded mt-4 w-full font-semibold transition"
                        data-student="{{ $student->id }}">
                    Call
                </button>
            </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Video container -->
<div id="videoContainer" class="fixed inset-0 bg-black bg-opacity-90 hidden z-50 flex items-center justify-center flex-col p-4">
    <div class="flex gap-4 items-center mb-4">
        <button id="toggleCamera" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition">🎥 Camera</button>
        <button id="toggleMic" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded transition">🎤 Mic</button>
    </div>
    <div class="flex flex-col md:flex-row gap-4 w-full max-w-5xl justify-center items-center">
        <video id="teacherVideo" autoplay playsinline class="w-full md:w-1/2 border-4 border-blue-500 rounded-lg shadow-lg"></video>
        <video id="studentVideo" autoplay playsinline class="w-full md:w-1/2 border-4 border-green-500 rounded-lg shadow-lg"></video>
    </div>
    <button id="endCall" class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded mt-6 font-bold transition">End Call</button>
</div>

<script>
let localStream;
let peerConnection;
const config = { 'iceServers': [{ 'urls': 'stun:stun.l.google.com:19302' }] };

// When teacher clicks "Call"
document.querySelectorAll('.call-btn').forEach(btn => {
    btn.addEventListener('click', async function() {
        const studentId = this.dataset.student;

        // Show video container
        document.getElementById('videoContainer').style.display = 'flex';

        // Get camera/mic
        localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
        document.getElementById('teacherVideo').srcObject = localStream;

        // Setup peer connection
        peerConnection = new RTCPeerConnection(config);
        localStream.getTracks().forEach(track => peerConnection.addTrack(track, localStream));

        peerConnection.ontrack = function(event) {
            document.getElementById('studentVideo').srcObject = event.streams[0];
        };

        // Make offer (in real project send this via Pusher to student)
        const offer = await peerConnection.createOffer();
        await peerConnection.setLocalDescription(offer);

        console.log("Teacher created offer, should send via signaling server.");
    });
});

// End call button
document.getElementById('endCall').addEventListener('click', () => {
    if(peerConnection) peerConnection.close();
    if(localStream) localStream.getTracks().forEach(track => track.stop());
    document.getElementById('videoContainer').style.display = 'none';
});

// Toggle camera/mic
document.getElementById('toggleCamera').addEventListener('click', () => {
    const videoTrack = localStream.getVideoTracks()[0];
    videoTrack.enabled = !videoTrack.enabled;
    document.getElementById('toggleCamera').textContent = videoTrack.enabled ? '🎥 Camera' : '❌ Camera';
});
document.getElementById('toggleMic').addEventListener('click', () => {
    const audioTrack = localStream.getAudioTracks()[0];
    audioTrack.enabled = !audioTrack.enabled;
    document.getElementById('toggleMic').textContent = audioTrack.enabled ? '🎤 Mic' : '❌ Mic';
});

// Teacher listens for student answer
const teacherId = {{ session('teacher_user')->id }};
const channelTeacher = pusher.subscribe('teacher-' + teacherId);

// When student accepts/rejects
channelTeacher.bind('App\\Events\\VideoCallAccepted', function(data) {
    if(data.call.status === 'accepted'){
        alert('✅ Student accepted your call! Starting video...');
    } else if(data.call.status === 'rejected'){
        alert('❌ Student rejected your call.');
    }
});
</script>

</body>
</html>
