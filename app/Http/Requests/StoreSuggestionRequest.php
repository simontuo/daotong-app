<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSuggestionRequest extends FormRequest
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
            'bio'          => 'required',
            'markdown_bio' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'bio'          => '建议不能为空！',
            'markdown_bio' => 'markdown_bio不能为空！',
        ];
    }
}
