<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ChapterRequest extends Request
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
        ];
    }

    /**
     * @return array
     */

    public function messages()
    {
        return [
            'txtName.required'    => 'Bạn phải nhập tên chương !',
            'txtSubname.required' => 'Bạn phải điền tên mục chương !'
        ];
    }
}
