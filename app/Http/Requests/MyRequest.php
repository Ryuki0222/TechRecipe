<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MyRequest extends FormRequest
{
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
            'work_img' => 'image|mimes:jpeg,bmp,png,gif',
            'work_name' => '',
            'skills' => '',
            'github_url' => '',
            'work_description' => '',
        ];
    }
}
