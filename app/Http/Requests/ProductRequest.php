<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use LDAP\Result;

class ProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     */
    public function messages()
    {
        return [
            'name.required'        => 'Tên sản phẩm không được để trống',
            
            'price.required'       => 'Giá sản phẩm không được để trống',
           
            'quantity.required'    => 'Số lượng không được để trống',
           
            'image.required'          => 'Hình ảnh phải là tệp ảnh và không trống',
            
            'category_id.required' => 'Danh mục không được để trống',
           
            'description.required'   => 'Mô tả sản phẩm k trống',
           
            'status.required'      => 'Trạng thái không được để trống',
            'status.boolean'       => 'Trạng thái phải là Hoạt động hoặc Tạm dừng',
        ];
    }
}
