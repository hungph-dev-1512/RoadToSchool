<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Auth;

class GetConversationMessageFromPusherEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $fromUser;
    public $toUser;
    public $createdTime;
    public $is_in_progress;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $is_in_progress)
    {
        $this->message = $message;
        $this->fromUser = \App\Models\User::findOrFail($message->from_id);
        $this->toUser = \App\Models\User::findOrFail($message->conversation->user_sender_id);
        $this->createdTime = $message->created_at->toTimeString();
        $this->is_in_progress = $is_in_progress;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['conversation-message'];
    }
}
