<?php

namespace App\Events;

use App\Models\VideoCall;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class VideoCallAccepted implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $call;

    public function __construct(VideoCall $call)
    {
        $this->call = $call;
    }

    public function broadcastOn()
    {
        // Send the event to the teacher channel
        return new Channel('teacher-'.$this->call->teacher_id);
    }

    public function broadcastAs()
    {
        return 'VideoCallAccepted';
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->call->id,
            'teacher_id' => $this->call->teacher_id,
            'student_id' => $this->call->student_id,
            'status' => $this->call->status,
            'room_id' => $this->call->room_id ?? null,
        ];
    }
}
