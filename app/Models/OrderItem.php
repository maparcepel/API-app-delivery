<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class OrderItem extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unit_price'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function order(){
        return $this->belonsTo(Order::class);
    }
}
