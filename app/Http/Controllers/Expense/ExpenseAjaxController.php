<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Traits\Expense\ValidateExpenseTrait;

class ExpenseAjaxController extends Controller
{
    use ValidateExpenseTrait;

    public function store()
    {
      Expense::create($this->validation());
      return response()->json([
          'status' => true
      ]);
    }
    public function update($id)
    {
        Expense::findOrFail($id)->update($this->validation());
    }
    public function destroy($id)
    {
      Expense::findOrFail($id)->delete();
      return response()->json([
          'status' => true
      ]);
    }
}
