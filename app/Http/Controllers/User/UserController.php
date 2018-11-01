<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * The user model instance.
     */
    protected $modelUser;

    /**
     * Create a new controller instance.
     *
     * @param  User  $users
     * @return void
     */
    public function __construct(User $users)
    {
        $this->modelUser = $users;
    }

    /**
     * Show detail user
     *
     * @param mixed $id
     * @return void
     */
    public function show($id)
    {
        $selectedUser = $this->modelUser->findUser($id);
        
        // Get difftime from last login to now.
        // $diffTime = \Carbon\Carbon::parse($selectedUser->last_login)->diffForHumans();
        // Get all province from database.
        $selectProvince = \App\Models\Province::all()->pluck('name', 'id');

        return view('user.users.show', compact(
            'selectedUser',
            'diffTime',
            'selectProvince'
        ));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $data = $request->all();
        $result = $this->modelUser->updateUser($data, $id);
        
        if ($result) {
            flash(__('messages.update_successfully'))->success();
        } else {
            flash(__('messages.update_failed'))->error();
        }

        return redirect()->route('users.show', $id);
    }
}
