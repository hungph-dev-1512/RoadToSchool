<?php

namespace App\Http\Controllers\Admin;

use App\Models\Conversation;
use App\Models\ConversationMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConversationController extends Controller
{
    protected $modelConversation;
    protected $modelConversationMessage;

    public function __construct(Conversation $conversation, ConversationMessage $conversationMessage)
    {
        $this->modelConversation = $conversation;
        $this->modelConversationMessage = $conversationMessage;
    }

    public function getWaitingList()
    {
        $conversationList = $this->modelConversation->where('admin_receiver_id', \Auth::user()->id)
            ->orWhere('status', \App\Models\Conversation::WAITING)
            ->orWhere('status', \App\Models\Conversation::DONE)
            ->get();

        $waitingConversationList = $this->modelConversation->where('status', \App\Models\Conversation::WAITING)->get();
        $inProgressConversationList = $this->modelConversation->where('admin_receiver_id', \Auth::user()->id)->where('status', \App\Models\Conversation::IN_PROGRESS)->get();
        $doneConversationList = $this->modelConversation->where('admin_receiver_id', \Auth::user()->id)->where('status', \App\Models\Conversation::DONE)->get();

        return view('admin.conversations.waiting_list', compact(
            'conversationList',
            'waitingConversationList',
            'inProgressConversationList',
            'doneConversationList'
        ));
    }
}
