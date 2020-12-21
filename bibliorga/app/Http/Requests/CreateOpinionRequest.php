<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOpinionRequest extends FormRequest
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
            'grade' => 'required|integer|min:0|max:5',
            'description' => 'required|string',
            'title' => 'required|string|max:50',
            'book_id'=> 'required|integer|exists:books,id'
        ];
    }
}
