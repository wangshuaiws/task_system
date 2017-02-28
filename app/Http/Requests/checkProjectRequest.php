<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class checkProjectRequest extends Request
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
            'name' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '这个任务名称是必填的',
            'name.max' => '名称不能过长'
        ];
    }
}
