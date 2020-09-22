<?php

namespace App\Http\Controllers\Delegate;

use App\Http\Controllers\Controller;
use App\Http\Requests\DelegateRequest;
use App\Traits\Delegate\ValidateDelegateTrait;
use Illuminate\Support\Facades\App;
use App\Models\Delegate;

class DelegateAjaxController extends Controller
{
  use  ValidateDelegateTrait;

  public function store(DelegateRequest $request)
  {
    event(new \App\Events\DelegateEvent($request->toArray()));
    return response()->json(['status' => true]);
  }

  public function update(DelegateRequest $request)
  {
    Delegate::findOrFail($request->id)->update($request->validated());
    return response()->json(['status' => true]);
  }

  public function destroy($id)
  {
    $delegate = Delegate::findOrFail($id);
    if ($delegate->image) {
      unlink(public_path('images/delegate/' . $delegate->image));
    }
    $delegate->delete();
    $delegate->orders()->delete();
    return response()->json(['status' => true,]);
  }

  public function search()
  {
    if (isset(request()->searchVal)) {
      $delegates = Delegate::where(
        'name',
        'like',
        '%' . request()->get('searchVal') . '%'
      )->get();
      try {
        $searchSection = view('project.delegate.search_delegate', [
          'delegates' => $delegates
        ])->renderSections();
      } catch (\Throwable $e) {
        dd($e);
      }
      return response([
        'searchSection' => $searchSection['searchSection']
      ]);
    }
  }

  public function report()
  {
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML(request()->get('delegate_table'));
    return $pdf->stream();
    // use Barryvdh\DomPDF\Facade as PDF;
    // $pdf = PDF::loadView('project.delegate.index_delegate', ['filter' => 0]);
    // return $pdf->download('delegates.pdf');
  }
}
