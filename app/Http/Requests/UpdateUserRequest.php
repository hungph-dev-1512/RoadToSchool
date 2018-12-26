<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->has('update_info')) {
            return [
                'name' => 'required|min:3',
                'address' => 'required',
                'grade' => 'required',
            ];
        }

        if ($this->has('update_password')) {
            return [
                'old_password' => 'required',
                'new_password' => 'required|between:8,50|alpha_num',
                'password_confirmation' => 'required_with:new_password|same:password',
            ];
        }
    }
}
