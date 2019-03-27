<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoryRequest extends Request
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
            'txtName' => 'required|unique:stories,name',
            //'fImages'  => 'image',
            'intCategory' => 'required',
            'intAuthor'   => 'required'
        ];
    }

    public function messages()
    {
        return [
            'txtName.required'    => 'Bạn phải nhập tên truyện !',
            'txtName.unique'    => 'Bài viết này đã tồn tại !',
            //'fImages.image'       => 'Tệp này không phải là hình ảnh !',
            'intCategory.required'=> 'Bạn phải chọn chuyên mục !',
            'intAuthor.required'  => 'Bạn phải chọn tác giả !'
        ];
    }
}
