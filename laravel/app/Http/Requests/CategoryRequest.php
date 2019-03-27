<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CategoryRequest extends Request
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
            'txtCategoryName' => 'required|unique:categories,name',
        ];
    }

    public function messages()
    {
        return [
            'txtCategoryName.required' => 'Vui lòng nhập tên chuyên mục',
            'txtCategoryName.unique'   => 'Chuyên mục này đã tồn tại',
        ];
    }
}
