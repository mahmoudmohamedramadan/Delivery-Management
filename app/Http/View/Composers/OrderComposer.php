<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class OrderComposer
{
  public function compose(View $view)
  {
    // get orders data
    $orders = \App\Models\Order::paginate(15);

    $view->with('orders', $orders);
  }
}
