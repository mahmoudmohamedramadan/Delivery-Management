<?php

namespace App\Http\Controllers\Delegate;

use App\Models\Delegate;
use App\Http\Controllers\Controller;

class DelagateDBRelation extends Controller
{
    public function DelegateOrderRelation()
    {
        if (request()->filter == 0) {
            $delegates = Delegate::get();
            
            $filterSection = view('project.delegate.filter_delegate')
                ->with(['delegates' => $delegates, 'filter' => 0])
                ->renderSections();

            return response()->json([
                'delegate_rows' => $filterSection['filterSection'],
            ]);
        } else if (request()->filter == 1) {
            #region whereHas
            // $delegate = Delegate::find(1);
            // here will return all delegates which has orders-orders relation not
            // model-
            // $delegates = Delegate::whereHas('orders')->get();
            // here will find delegate which it's id equal 2 and has order
            // $delegates = Delegate::whereHas('orders')->find(1);
            // you should return the value of object -like $delegate-which you hide
            // some attributes in the same line
            // $delegate->makeVisible(['name']);
            // $delegate->makeHidden(['name']);
            #endregion
            $delegates = Delegate::whereHas('orders')->get();
            // $delegates = Delegate::whereHas('orders',function($query){
            //     $query->where('id',1);
            // })->get();
            $filterSection = view('project.delegate.filter_delegate')
                ->with(['delegates' => $delegates, 'filter' => 1])
                ->renderSections();
            return response()->json([
                'delegate_rows' => $filterSection['filterSection'],
            ]);

        } else if (request()->filter == 2) {
            #region with
            // $delegates = Delegate::with('orders')->find(1);
            // $delegates = Delegate::with(['orders' => function($q){
            //     $q->select('delegate_id','shop_name');
            //     $q->select('id','shop_name');
            // >> notice difference between upper two lines that foreign key should
            // be selected
            // }])->get();
            #endregion
            #region GlobalScope
            // when call class which implements the Scope interface the query builder will put after scope resoultion operator(::)
            // $delegateWithOrders = Delegate::get();
            #endregion
            $delegates = Delegate::with('orders')->get();
            $filterSection = view('project.delegate.filter_delegate')
                ->with(['delegates' => $delegates, 'filter' => 2])
                ->renderSections();
            return response()->json([
                'delegate_rows' => $filterSection['filterSection'],
            ]);
        } else {
            // $delegates = Delegate::whereDoesntHave('orders')->get();
            // $delegates = Delegate::whereDoesntHave('orders')->find(1);
            $delegates = Delegate::whereDoesntHave('orders')->get();
            // $delegates = Delegate::whereDoesntHave('orders',function($query){
            //     $query->where('id',1);
            // })->get();
            //return response()->json($delegates);
            $filterSection = view('project.delegate.filter_delegate')
                ->with(['delegates' => $delegates, 'filter' => 3])
                ->renderSections();
            return response()->json([
                'delegate_rows' => $filterSection['filterSection'],
            ]);
        }
    }
}
