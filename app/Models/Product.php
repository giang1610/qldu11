<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $filllable = [
        'name',
        'price',
        'quantity',
        'image',
        'category_id',
        'description',
        'status',
    ];
}
