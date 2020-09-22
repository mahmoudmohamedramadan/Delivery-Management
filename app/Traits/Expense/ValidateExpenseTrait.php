<?php

namespace App\Traits\Expense;

trait ValidateExpenseTrait {
  public function validation()
  : array {
    return request()->validate([
      'id'   => 'required', 'type' => 'required|max:30',
      'info' => 'required|max:30', 'sum' => 'required|numeric', 'notes' => '',
    ]);
  }
}
