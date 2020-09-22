<?php

namespace App\Http\Controllers\Expense;

use App\Models\Expense;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Traits\Expense\ValidateExpenseTrait;

class ExpenseController extends Controller {
  use ValidateExpenseTrait;

  public function index() {
    $expenses = DB::table('expenses')->paginate(30);
    return view('project.expense.index_expense', ['expenses' => $expenses]);
  }

  public function create() {
    return view('project.expense.create_expense');
  }

  public function store() {
    Expense::create($this->validation());
    session()->flash('message', 'data saved successfully');
    return redirect()->back();
  }

  public function edit($id) {
    $expense = Expense::findOrFail($id);
    return view('project.expense.edit_expense', ['expense' => $expense]);
  }

  public function update($id) {
    Expense::findOrFail($id)->update($this->validation());
    return redirect()->to('/index/expense');
  }

  public function destroy($id) {
    Expense::findOrFail($id)->delete();
    return redirect()->to('/index/expense');
  }
}
