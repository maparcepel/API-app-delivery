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

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
    
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }
}
