<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostCreateRequest extends FormRequest
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
                'title'         => 'required|min:5|max:200',
                'slug'          => 'max:200',
                'content_raw'   => 'required|string|min:5|max:10000',
                'category_id'   => 'required|integer|exists:blog_categories,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @param array
     */
    public function messages()
    {
        return [
            'title.required'       => 'Введите заголовок статьи',
            'title.min' => 'Минимальная длинна заголовка [:min] символа',
            'title.max' => 'Максимальная длинна заголовка [:max] символа',
            'content_raw.min' => 'Минимальная длинна статьи [:min] символа',
            'content_raw.max' => 'Максимальна длинна статьи [:max] символов'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @param array
     */
     public function attributes()
     {
         return [
             'title' => 'Заголовок',
             ];
     }

}
