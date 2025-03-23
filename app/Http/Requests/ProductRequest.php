<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'quantity'    => 'required|integer|min:0',
            'image'       => $this->isMethod('post') ? 'required|image|mimes:jpeg,png,jpg,gif|max:2048' : 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string|max:1000',
            'status'      => 'required|boolean'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     */
    public function messages()
    {
        return [
            'name.required'        => 'Tên sản phẩm không được để trống',
            'name.string'          => 'Tên sản phẩm phải là chuỗi ký tự',
            'name.max'             => 'Tên sản phẩm tối đa 255 ký tự',
            'price.required'       => 'Giá sản phẩm không được để trống',
            'price.numeric'        => 'Giá sản phẩm phải là số',
            'price.min'            => 'Giá sản phẩm không được âm',
            'quantity.required'    => 'Số lượng không được để trống',
            'quantity.integer'     => 'Số lượng phải là số nguyên',
            'quantity.min'         => 'Số lượng không được âm',
            'image.image'          => 'Hình ảnh phải là tệp ảnh',
            'image.required'          => 'Hình ảnh phải là tệp ảnh và không trống',
            'image.mimes'          => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif',
            'image.max'            => 'Hình ảnh tối đa 2MB',
            'category_id.required' => 'Danh mục không được để trống',
            'category_id.exists'   => 'Danh mục không hợp lệ',
            'description.string'   => 'Mô tả sản phẩm phải là chuỗi ký tự',
            'description.required'   => 'Mô tả sản phẩm k trống',
            'description.max'      => 'Mô tả sản phẩm tối đa 1000 ký tự',
            'status.required'      => 'Trạng thái không được để trống',
            'status.boolean'       => 'Trạng thái phải là Hoạt động hoặc Tạm dừng',
        ];
    }
}
