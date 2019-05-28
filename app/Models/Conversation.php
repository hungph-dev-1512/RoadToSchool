<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $table = 'conversations';

    protected $fillable = [
        'user_sender_id',
        'admin_receiver_id',
        'status',
    ];

    const WAITING = 0;
    const IN_PROGRESS = 1;
    const DONE = 2;

    public static $status = [
        self::WAITING => 'Waiting answer',
        self::IN_PROGRESS => 'In progress',
        self::DONE => 'Done',
    ];

    public function conversation_messages()
    {
        return $this->hasMany('App\Models\ConversationMessage');
    }
}
