<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use App\Traits\Expense\ValidateExpenseTrait;

class ExpenseAjaxController extends Controller
{
    use ValidateExpenseTrait;

    public function store()
    {
        $data = \App\Models\Expense::create($this->validation());
        if ($data) {
            return response()->json([
                'status' => true
            ]);
        }
    }
    public function update($id)
    {
        \App\Models\Expense::findOrFail($id)->update($this->validation());
    }
    public function destroy($id)
    {
        \App\Models\Expense::findOrFail($id)->delete();
        return response()->json([
            'status' => true
        ]);
    }
}
