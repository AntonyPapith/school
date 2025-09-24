
<h2 class="text-2xl font-bold mb-4">Video Room</h2>
<div class="grid grid-cols-2 gap-4">
    <video id="localVideo" autoplay muted class="w-full border rounded"></video>
    <video id="remoteVideo" autoplay class="w-full border rounded"></video>
</div>

<script>
let localStream, peer;

async function init() {
    localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
    document.getElementById('localVideo').srcObject = localStream;

    peer = new RTCPeerConnection();
    localStream.getTracks().forEach(track => peer.addTrack(track, localStream));

    peer.ontrack = e => document.getElementById('remoteVideo').srcObject = e.streams[0];

    // TODO: Exchange ICE candidates via Pusher
}
init();
</script>
