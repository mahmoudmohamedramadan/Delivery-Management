<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Delegate;
use App\Models\Order;
use App\Traits\Order\ValidateOrderTrait;

class OrderAjaxController extends Controller
{
    use ValidateOrderTrait;

    public function store()
    {
        Order::create($this->validation());
        return response()->json([
            'status' => true,
        ]);
    }

    public function show(Delegate $delegate)
    {
        $orderSection = view('project.order.filter_order')->with(['orders' => $delegate->orders])
            ->renderSections();
        return response()->json([
            'status' => true,
            'orders' => $orderSection['orderSection'],
        ]);
    }

    public function update($id)
    {
        Order::findOrFail($id)->update($this->validation());
        return response()->json([
            'status' => true,
        ]);
    }

    public function destroy($id)
    {
        Order::findOrFail($id)->delete();
        return response()->json([
            'status' => true,
        ]);
    }

    public function search()
    {
        $orders = Order::where('shop_name', 'like',
            '%' . request()->get('searchVal') . '%')->get();
        try {
            $searchSection = view('project.order.search_order', [
                'orders' => $orders,
            ])->renderSections();
        } catch (\Throwable $e) {
            dd($e);
        }
        return response([
            'searchSection' => $searchSection['searchSection'],
        ]);
    }
}
