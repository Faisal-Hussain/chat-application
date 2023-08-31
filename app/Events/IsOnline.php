<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class IsOnline implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public function __construct()
    {
    }


    /**
     * @return \Illuminate\Broadcasting\Channel|\Illuminate\Broadcasting\Channel[]|PrivateChannel|string|string[]
     */
    public function broadcastOn()
    {
        return new Channel('online');
    }

    /**
     * @return string
     */
    public function broadcastAs()
    {
        return 'server.online';
    }

}





