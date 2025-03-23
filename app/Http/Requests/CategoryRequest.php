<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name'=>'required|string|max:225',
            'status'=>'required|boolean'
        ];
        
    }
    public function messages()
        {
            return[
                'name.required'=>'k trống',
                'name.string'=>'tên danh muc chuỗi kí tự',
                'name.max'=>'tên danh mục tối <= 255',
                'status.required'=>'trạng thái k trống',
                'status.boolen'=>'tên danh mục hoạt động, tạm dựng',
            ];
        }
}
