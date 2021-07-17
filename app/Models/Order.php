<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Order extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'user_id',
        'pickup_day',
        'pickup_time',
        'address',
        'payment_type'
    ];
}
