<?php

namespace App\Traits\Order;

trait ValidateOrderTrait {
  public function validation()
  : array {
    return request()->validate([
      'delegate_id'      => 'required', 'shop_name' => 'required|max:40',
      'customer_address' => 'required|max:40', 'phone' => 'required|numeric',
      'order_fees'       => 'required', 'delivery_value' => 'required|numeric',
      'delivery_date'    => 'required'
    ]);
  }
}
