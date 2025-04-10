<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DatVeDuLichRequest extends FormRequest
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
            'ten_nguoi_dat' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'so_luong' => 'required|integer|min:1',
            'hinh_thuc_thanh_toan' => 'required|in:tien_mat,chuyen_khoan,vi_dien_tu',
        ];
    }

    public function messages()
    {
        return [
            'ten_nguoi_dat.required' => 'Vui lòng nhập tên người đặt.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'so_luong.required' => 'Vui lòng nhập số lượng người.',
            'so_luong.integer' => 'Số lượng phải là số nguyên.',
            'so_luong.min' => 'Số lượng ít nhất là 1.',
            'hinh_thuc_thanh_toan.required' => 'Vui lòng chọn hình thức thanh toán.',
            'hinh_thuc_thanh_toan.in' => 'Hình thức thanh toán không hợp lệ.',
        ];
    }
}
