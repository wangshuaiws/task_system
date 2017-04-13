<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditProjectRequest extends Request
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
            'name' => 'required|unique:projects',
            //'title' => 'required|unique:projects'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '这个项目名称是必填的',
            'name.unique' => '抱歉，这个项目名称已经有了',
            'thumbnail.image' => '请上传图片类型格式的文件',
            'thumbnail.dimensions' => '上传的尺寸过小，请上传是261X98像素的图片'
        ];
    }
}
