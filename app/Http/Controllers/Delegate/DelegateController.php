<?php

namespace App\Http\Controllers\Delegate;

use App\Models\Delegate;
use App\Http\Controllers\Controller;
use App\Traits\Delegate\ValidateDelegateTrait;
use Illuminate\Notifications\Notifiable;

class DelegateController extends Controller
{
  use Notifiable, ValidateDelegateTrait;

  public function index()
  {
    // data passed using View Composer(AppServiceProvider) in boot method(First Way).
    return view('project.delegate.index_delegate')->with('filter', 0);
  }

  public function create()
  {
    return view('project.delegate.create_delegate')->with([
      'cars' => \App\Models\Car::get(), 'car_count' => \App\Models\Car::count()
    ]);
  }

  public function store()
  {
    /* notice that after execute whatever in listener it return again here from the place which you call event */
    event(new \App\Events\DelegateEvent($this->validation()));
    session()->flash('message', 'data saved successfully');
    return redirect()->to('/index/delegate/create');
  }

  public function destroy($id)
  {
    $delegate = Delegate::findOrFail($id);
    if ($delegate->image) {
      unlink(public_path('images/delegate/' . $delegate->image));
    }
    $delegate->delete();
    /*
    whereNull whereNotNull whereIn >> keywords maybe you use
    here when you call method of scopeId the return query will be replaced
    with this id after scope resolution operator(::)
     */
    $delegate->orders()->delete();
    return redirect()->back();
  }
}
