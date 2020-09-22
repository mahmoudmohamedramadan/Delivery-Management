<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {
  protected $fillable = [
    'delegate_id', 'shop_name', 'customer_address', 'phone', 'order_fees',
    'delivery_value', 'delivery_date'
  ];

  public function delegate()
  : \Illuminate\Database\Eloquent\Relations\BelongsTo {
    return $this->belongsTo(\App\Models\Delegate::class, 'delegate_id', 'id',
      'delegates');
  }

  public function expenses()
  : \Illuminate\Database\Eloquent\Relations\HasMany {
    return $this->hasMany(\App\Models\Expense::class);
  }
}
