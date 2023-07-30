<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'delegate_id', 'shop_name', 'customer_address', 'phone', 'order_fees',
        'delivery_value', 'delivery_date'
    ];

    public function delegate()
    {
        return $this->belongsTo(
            \App\Models\Delegate::class,
            'delegate_id',
            'id',
            'delegates'
        );
    }

    public function expenses()
    {
        return $this->hasMany(\App\Models\Expense::class);
    }
}
