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
        'produsct_id',
        'quantity',
        'unit_price'
    ];
}
