<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'يجب إضافة عنوان للمقال !',
            'main_image.required' => 'يجب إضافة صورة رئيسية للمقال !',
            'main_image.image' => 'يجب أن يكون الملف صورة !',
            'content.required' => 'يجب إضافة محتوى للمقال !',
        ];
    }
}
