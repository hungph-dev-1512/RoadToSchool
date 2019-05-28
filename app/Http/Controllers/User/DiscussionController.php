<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Discussion;
use App\Events\GetDiscussionFromPusherEvent;

class DiscussionController extends Controller
{
    public $modelDiscussion;

    public function __construct(Discussion $discussion)
    {
        $this->modelDiscussion = $discussion;
    }

    public function createNewDiscussion(Request $request)
    {
        $data = $request->all();
        $result = $this->modelDiscussion->createNewDiscussion($data);
        $createdDiscussion = $this->modelDiscussion->orderBy('created_at', 'desc')->limit(1)->first();
        $createdDiscussionId = $createdDiscussion->id;

        if ($result) {
            event(new GetDiscussionFromPusherEvent($data['content'], $data['userId'], $createdDiscussionId));

            return 201;

        }

        return 500;
    }
}
