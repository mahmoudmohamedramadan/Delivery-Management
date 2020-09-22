<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Traits\Order\ValidateOrderTrait;

class OrderController extends Controller {
  use ValidateOrderTrait;

  public function index() {
    // data passed using View Composer in boot method(Third/Last Way).
    return view('project.order.index_order');
  }

  public function create() {
    $delegates = \App\Models\Delegate::all();
    return view('project.order.create_order')->with(['delegates' => $delegates]);
  }

  public function store() {
    \App\Models\Order::create($this->validation());
    return redirect()->back()->with('message', 'data saved successfully');
  }

  public function edit($id) {
    $order = \App\Models\Order::findorFail($id);
    $delegates = \App\Models\Delegate::all()->except($order->delegate_id);
    return view('project.order.edit_order')->with([
      'order' => $order, 'delegates' => $delegates
    ]);
  }

  public function update($id) {
    $order = \App\Models\Order::findorFail($id);
    $order->update($this->validation());
    return redirect()->to('/index/delegate-order');
  }

  public function destroy($id) {
    $order = \App\Models\Order::findOrFail($id);
    $order->delete();
    return redirect()->to('/index/delegate-order');
  }
}
