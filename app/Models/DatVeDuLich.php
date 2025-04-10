<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatVeDuLich extends Model
{
    public $timestamps = false;
    protected $table = 'dat_ve_du_lich';
    protected $fillable = [
        'ten_nguoi_dat',
        'email',
        'so_luong',
        'tong_tien',
        'hinh_thuc_thanh_toan',
        'trang_thai',
    ];
}
