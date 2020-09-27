<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Traits\Order\ValidateOrderTrait;

class OrderController extends Controller {
  use ValidateOrderTrait;

  public function index() {
    // data passed using View Composer in boot method(Third/Last Way).
    return view('project.order.index_order');
  }

  public function create() {
    return view('project.order.create_order');
  }

  public function store() {
    Order::create($this->validation());
    return redirect()->back()->with('message', 'data saved successfully');
  }

  public function edit($id) {
    $order = Order::findorFail($id);
    return view('project.order.edit_order')->with([
      'order' => $order
    ]);
  }

  public function update($id) {
    Order::findorFail($id)->update($this->validation());
    return redirect()->to('/index/delegate-order');
  }

  public function destroy($id) {
    Order::findOrFail($id)->delete();
    return redirect()->to('/index/delegate-order');
  }
}
