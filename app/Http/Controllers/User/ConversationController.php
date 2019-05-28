<?php

namespace App\Http\Controllers\User;

use App\Models\Conversation;
use App\Models\ConversationMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\GetConversationMessageFromPusherEvent;

class ConversationController extends Controller
{
    protected $modelConversation;
    protected $modelConversationMessage;

    public function __construct(Conversation $conversation, ConversationMessage $conversationMessage)
    {
        $this->modelConversation = $conversation;
        $this->modelConversationMessage = $conversationMessage;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $findConversation = $this->modelConversation->where('user_sender_id', $data['user_sender_id'])->first();
        $data['status'] = $this->modelConversation::WAITING;
        $is_in_progress = 0;
        if ($findConversation) {
            $createdMessage = $this->modelConversationMessage->create([
                'content' => $data['content'],
                'from_id' => \Auth::user()->id,
                'conversation_id' => $findConversation->id
            ]);
            $responseData['createdConversation'] = $findConversation;
            if ($findConversation->status == Conversation::DONE) {
                $is_in_progress = 0;
            } else if ($findConversation->status == Conversation::IN_PROGRESS) {
                $is_in_progress = 1;
            }
        } else {
            $createdConversation = $this->modelConversation->create($data);
            $createdMessage = $this->modelConversationMessage->create([
                'content' => $data['content'],
                'from_id' => \Auth::user()->id,
                'conversation_id' => $createdConversation->id
            ]);
            $responseData['createdConversation'] = $createdConversation;
            $is_in_progress = 0;
        }
        event(new GetConversationMessageFromPusherEvent($createdMessage, $is_in_progress));
        $responseData['message'] = $createdMessage;
        $responseData['created_time'] = $createdMessage->created_at->toTimeString();
        $responseData['sender'] = \Auth::user();

        return json_encode($responseData);
    }

    // For admin
    public function storeNewMessage(Request $request, $conversationId)
    {
        $data = $request->all();

        $createdMessage = $this->modelConversationMessage->create([
            'content' => $data['content'],
            'from_id' => \Auth::user()->id,
            'conversation_id' => $conversationId
        ]);

        event(new GetConversationMessageFromPusherEvent($createdMessage, 1));

        return 201;
    }

    public function changeConversationStatus(Request $request, $conversationId)
    {
        $data = $request->all();
        $findConversation = $this->modelConversation->findOrFail($conversationId);
        $findConversation->update(['status' => $data['status'], 'admin_receiver_id' => \Auth::user()->id]);
        $responseData['moveStatus'] = $data['status'];

        return 201;
    }
}
