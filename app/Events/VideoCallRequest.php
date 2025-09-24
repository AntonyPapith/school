<?php

namespace App\Events;

use App\Models\VideoCall;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class VideoCallRequest implements ShouldBroadcast
{
    use SerializesModels;

public $call;
public $teacher_name;

public function __construct(VideoCall $call)
{
    $this->call = $call;
    $this->teacher_name = $call->teacher->name; // Teacher relation
}

public function broadcastWith()
{
    return [
        'call_id' => $this->call->id,
        'teacher_name' => $this->call->teacher->name,
    ];
}


    public function broadcastAs(): string
    {
        return 'VideoCallRequest';
    }
}
