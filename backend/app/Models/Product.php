<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'brand',
        'category',
        'image',
        'price',
        'price_sale',
        'stock',
    ];

    protected $casts = [
        'price' => 'float',
        'price_sale' => 'float',
        'stock' => 'float',
    ];
}
