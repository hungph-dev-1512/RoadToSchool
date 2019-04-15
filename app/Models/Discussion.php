<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $table = 'discussions';

    protected $fillable = [
        'content',
        'lecture_id',
        'user_id',
    ];

    public function lecture()
    {
        return $this->belongsTo('App\Models\Lecture');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function createNewDiscussion($data)
    {
        $data['lecture_id'] = $data['lectureId'];
        $data['user_id'] = $data['userId'];

        return Discussion::create($data);
    }
}
