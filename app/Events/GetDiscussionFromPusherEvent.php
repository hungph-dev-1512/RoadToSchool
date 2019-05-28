<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Auth;

class GetDiscussionFromPusherEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $content;
    public $userAvatar;
    public $userName;
    public $createdDiscussionId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($content, $userDiscussionId, $createdDiscussionId)
    {
        $this->content = $content;
        $this->userAvatar = str_replace('public/', '', asset(\App\Models\User::findOrFail($userDiscussionId)->avatar));
        $this->userName = \App\Models\User::findOrFail($userDiscussionId)->name;
        $this->createdDiscussionId = $createdDiscussionId;
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['discussion'];
    }
}
