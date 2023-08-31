<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    /**
     * @var User
     */
    public $user;

    /**
     * @var
     */
    public $users;

    /**
     * @var
     */
    public $message;


    /**
     * MessageSent constructor.
     * @param User $user
     * @param $message
     * @param $users
     */
    public function __construct(User $user, $message, $users)
    {
        $this->user = $user;
        $this->message = $message;
        $this->users = $users;
    }


    /**
     * @return \Illuminate\Broadcasting\Channel|\Illuminate\Broadcasting\Channel[]|PrivateChannel|string|string[]
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat.'. $this->user->id);
    }

    /**
     * @return string
     */
    public function broadcastAs()
    {
        return 'server.sent';
    }

}





