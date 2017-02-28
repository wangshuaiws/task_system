<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class updateProjectRequest extends Request
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
            'title' => 'required|max:255|unique:tasks'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '这个任务名称是必填的',
            'title.max' => '任务名称过长',
            'title.unique' => '任务名称已经存在'
        ];
    }
}
