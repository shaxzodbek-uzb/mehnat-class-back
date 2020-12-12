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
        return [
            'username' => "nullable|string|unique:users,username,".request()->id,
            'fullname' => 'required',
            'birth_date' => 'required',
            'gender' => 'nullable',
            'phone' => 'nullable',
            'avatar' => 'nullable',
            'background_img' => 'nullable'
        ];
    }
}
