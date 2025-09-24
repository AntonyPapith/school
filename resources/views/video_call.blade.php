<h2>Video Call</h2>
<video id="localVideo" autoplay muted style="width:300px"></video>
<video id="remoteVideo" autoplay style="width:300px"></video>

<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
let localStream;
let peerConnection;
const config = { iceServers: [{ urls: 'stun:stun.l.google.com:19302' }] };

// Show video container function
function showVideoContainer() {
    const container = document.getElementById('videoContainer');
    container.style.display = 'flex';
}

// Initialize teacher stream
async function initLocalStream() {
    localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
    document.getElementById('teacherVideo').srcObject = localStream;
}

// Create peer connection
function createPeerConnection() {
    peerConnection = new RTCPeerConnection(config);

    // Add local tracks
    localStream.getTracks().forEach(track => peerConnection.addTrack(track, localStream));

    // Show remote stream
    peerConnection.ontrack = function(event) {
        document.getElementById('studentVideo').srcObject = event.streams[0];
    };

    // ICE candidates logging (to be sent to student)
    peerConnection.onicecandidate = function(event) {
        if (event.candidate) {
            console.log("New ICE candidate:", event.candidate);
            // Send candidate to student via signaling
        }
    };
}

// Start call
async function startCall(studentId) {
    showVideoContainer();
    await initLocalStream();
    createPeerConnection();

    const offer = await peerConnection.createOffer();
    await peerConnection.setLocalDescription(offer);

    console.log("Offer SDP:", offer);
    // TODO: send offer to student via Laravel Echo / Pusher / Socket
}

// End call
function endCall() {
    if(peerConnection) peerConnection.close();
    if(localStream) localStream.getTracks().forEach(track => track.stop());
    document.getElementById('videoContainer').style.display = 'none';
}

// Toggle camera
function toggleCamera() {
    if (!localStream) return;
    const videoTrack = localStream.getVideoTracks()[0];
    videoTrack.enabled = !videoTrack.enabled;
    document.getElementById('toggleCamera').textContent = videoTrack.enabled ? '🎥 Camera' : '❌ Camera';
}

// Toggle mic
function toggleMic() {
    if (!localStream) return;
    const audioTrack = localStream.getAudioTracks()[0];
    audioTrack.enabled = !audioTrack.enabled;
    document.getElementById('toggleMic').textContent = audioTrack.enabled ? '🎤 Mic' : '❌ Mic';
}

// Event listeners
document.querySelectorAll('.call-btn').forEach(btn => {
    btn.addEventListener('click', () => startCall(btn.dataset.student));
});

document.getElementById('endCall').addEventListener('click', endCall);
document.getElementById('toggleCamera').addEventListener('click', toggleCamera);
document.getElementById('toggleMic').addEventListener('click', toggleMic);

</script>
