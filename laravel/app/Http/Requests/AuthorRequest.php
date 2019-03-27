<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AuthorRequest extends Request
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
            'txtAuthorName' => 'required|unique:authors,name',
        ];
    }

    public function messages()
    {
        return [
            'txtAuthorName.required' => 'Vui lòng nhập tên vào',
            'txtAuthorName.unique'   => 'Tác giả này đã tồn tại',
        ];
    }
}
