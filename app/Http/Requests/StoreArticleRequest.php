<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
            'cover' => 'url',
            'title' => 'required|max:20',
            'bio'   => 'required',
        ];
    }

    public function messages()
    {
        return [
            'cover.url' => "封面必须为有效的图片地址！",
            'title.required' => '标题不能为空！',
            'title.max' => '标题不能超过20个字符！',
            'bio.required' => '文章内容不能为空！',
        ];
    }
}
