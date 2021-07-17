<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Product extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'subcategory_id',
        'product_type',
        'description',
        'price'
    ];
}
