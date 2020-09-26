<?php

namespace App\Traits\Expense;

trait ValidateExpenseTrait
{
    public function validation()
    {
        return request()->validate([
            'type' => 'required|max:30',
            'info' => 'required|max:30', 'sum' => 'required|numeric', 'notes' => '',
        ]);
    }
}
