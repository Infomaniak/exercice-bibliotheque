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
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'birthday' => 'nullable|date_format:"Y-m-d"',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'attachment_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sex' => ['nullable', 'string', 'in:male,female'],
            'role' => ['nullable', 'string', 'in:admin,librarian,user'],
        ];
    }
}
