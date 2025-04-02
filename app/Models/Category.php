<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'status',
    ];
    // hasMany là 1-n
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
