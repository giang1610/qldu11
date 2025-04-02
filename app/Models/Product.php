<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    // trường hợp nếu để mặc định có trường timestamps
    //thì sd hàm sau để tắt timestamps (create_at , update_at)
    public $timestamps = false;
    protected $fillable = [
        'name',
        'price',
        'quantity',
        'image',
        'category_id',
        'description',
        'status',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

}
