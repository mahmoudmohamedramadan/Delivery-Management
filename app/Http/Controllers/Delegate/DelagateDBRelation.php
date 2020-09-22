<?php

namespace App\Http\Controllers\Delegate;

use App\Http\Controllers\Controller;
use App\Models\Delegate;
use Illuminate\Support\Facades\DB;

class DelagateDBRelation extends Controller {
  public function DelegateOrderRelation() {
    if (request()->filter === 0) {
      $delegates = DB::table('delegates')->paginate(30);
      return view('project.delegate.index_delegate',
        compact('delegates'))->with('filter', 0);
    } else if (request()->filter === 1) {
      #region whereHas
      // $delegate = \App\Models\Delegate::find(1);
      // here will return all delegates which has orders-orders relation not
      // model-
      // $delegates = \App\Models\Delegate::whereHas('orders')->get();
      // here will find delegate which it's id equal 2 and has order
      // $delegates = \App\Models\Delegate::whereHas('orders')->find(1);
      // you should return the value of object -like $delegate-which you hide
      // some attributes in the same line
      // $delegate->makeVisible(['name']);
      // $delegate->makeHidden(['name']);
      #endregion
      $delegates = Delegate::whereHas('orders')->paginate(30);
      // $delegates = Delegate::whereHas('orders',function($query){
      //     $query->where('id',1);
      // })->get();
      return view('project.delegate.index_delegate',
          compact('delegates'))->with('filter', 1);
    } else if (request()->filter === 2) {
      #region with
      // $delegates = \App\Models\Delegate::with('orders')->find(1);
      // $delegates = \App\Models\Delegate::with(['orders' => function($q){
      //     $q->select('delegate_id','shop_name');
      //     $q->select('id','shop_name');
      // >> notice difference between upper two lines that foreign key should
      // be selected
      // }])->get();
      #endregion
      #region GlobalScope
      // when call class which implements the Scope interface the query builder will put after scope resoultion operator(::)
      // $delegateWithOrders = \App\Models\Delegate::get();
      #endregion
      $delegates = Delegate::with('orders');
      return view('project.delegate.index_delegate',
        compact('delegates'))->with('filter', 2);
    } else {
      // $delegates = Delegate::whereDoesntHave('orders')->get();
      // $delegates = Delegate::whereDoesntHave('orders')->find(1);
      $delegates = Delegate::whereDoesntHave('orders')->paginate(30);
      // $delegates = Delegate::whereDoesntHave('orders',function($query){
      //     $query->where('id',1);
      // })->get();
      return view('project.delegate.index_delegate',
        compact('delegates'))->with('filter', 3);
    }
  }
}
