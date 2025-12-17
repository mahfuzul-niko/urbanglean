<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DraftOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'name',
        'phone',
        'shipping_address',
        'district_id',
        'price',
        'coupon_status',
        'coupon_code',
        'coupon_discount_amount',
        'delivery_charge',
        'total_payable',
        'paid',
        'note'
    ];

    public function products()
    {
        return $this->hasMany(DraftOrderProduct::class);
    }

}

