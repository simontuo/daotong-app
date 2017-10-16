<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCalligraphyRequest extends FormRequest
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
            'title' => 'required',
            'images' => 'required',
            'bio' => 'required',
        ];
    }

    /**
     * [messages description]
     * @return [type] [description]
     */
    public function messages()
    {
        return [
            'user_id.required' => '创建者ID不能为空！',
            'title.required' => '标题不能为空!',
            'images.required' => '图片不能为空！',
            'bio.required' => '描述不能为空！',
        ];
    }
}
