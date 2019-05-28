<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConversationMessage extends Model
{
    protected $table = 'conversation_messages';

    protected $fillable = [
        'content',
        'from_id',
        'conversation_id',
    ];

    public function conversation()
    {
        return $this->belongsTo('App\Models\Conversation');
    }
}
