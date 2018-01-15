<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
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
            'topics' => 'required|array',
            'title'  => 'required|max:20',
            'bio'    => 'required',
        ];
    }

    public function messages()
    {
        return [
            'topics.required'  => '话题不能不能为空！',
            'title.required' => '标题不能为空！',
            'title.max'      => '标题不能超过20个字符！',
            'bio.required'   => '文章内容不能为空！',
        ];
    }
}
