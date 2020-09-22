<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Traits\Order\ValidateOrderTrait;

class OrderAjaxController extends Controller {
  use ValidateOrderTrait;

  public function store() {
    $order = Order::create($this->validation());
    if ($order) {
      return response()->json([
        'status' => true
      ]);
    }
  }

  public function update($id) {
    $order = Order::findOrFail($id);
    $order->update($this->validation());
    return response()->json([
      'status' => true
    ]);
  }

  public function destroy($id) {
    $order = Order::findOrFail($id);
    $order->delete();
    return response()->json([
      'status' => true
    ]);
  }

  public function search() {
    $orders = Order::where('shop_name', 'like',
      '%' . request()->get('searchVal') . '%')->get();
    try {
      $searchSection = view('project.order.search_order', [
        'orders' => $orders
      ])->renderSections();
    } catch (\Throwable $e) {
      dd($e);
    }
    return response([
      'searchSection' => $searchSection['searchSection']
    ]);
  }
}
