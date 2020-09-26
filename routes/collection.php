<?php

Route::get('/chunk', function () {
  $delegates = \App\Models\Delegate::all();
  // here will chunk or split given collection into chunks.
  dd($delegates->chunk(2)); // here will make every two items into one array
});

Route::get('/take', function () {
  $delegates = \App\Models\Delegate::all();
  // here will return first two items in collection and it can accept
  dd($delegates->take(2));
  // here will return last two items in collection and it can accept
  dd($delegates->take(-2));
});

Route::get('/where', function () {
  /* here you will get data where id equal 1 and if or not if exist will get
   delegate where name equal delegate three ajax
  return \App\Models\Delegate::where('id',1)->orWhere('name','delegate ajax three')->get();
   */

  /* here i will get data if and only if id equal 1 and name equal delegate
  three ajax but i can't put these conditions in array but using methods
  chains
  */
  $delegates = \App\Models\Delegate::all();
  /*return $delegates->where('id', 1)->where('name', 'delegate one
   edit validate')->get();*/

  /* i can't put both conditions into array
     return $delegates->where(['id' => 1, 'name' => 'delegate one edit
     validate'])->get();

     but use this way because here you apply conditions into collection
     directly

    return \App\Models\Delegate::where(['id' => 1, 'name' => 'delegate one edit
    validate'])->get();
  */

  /* if there are multiple results and you want first row only use...
     return $delegates->where('image', '')->take(1);

      and upper line alias to this lowe line
      return $delegates->firstWhere('image', '');

    also you can use this line
    return $delegates->whereNull('image')->take(1);
   */
});

Route::get('each-map', function () {
  $delegates = \App\Models\Delegate::all();
  /* each keyword is performing something over each iterator so you can
    modify some thing but map get something performing in each iterator and put modified data in array then return it.
    ======================================================
    as you notice when use only in each will be no effect because you can't
    return modified data in new array like map
   */

  $delegate_each = $delegates->each(function ($delegate) {
    $delegate->name = 'modified name';
  });

  $delegate_map = $delegates->map(function ($delegate) {
    return $delegate->only('id', 'name');
  });
  dd($delegate_each, $delegate_map);
});

Route::get('sort', function () {
  $delegates = \App\Models\Delegate::all();
  // original sortBy specific key(table_column)
  $delegate = $delegates->sortBy('id');
  // descending sortBy specific key(table_column)
  return $delegates->sortBy('id', 8, 'Desc');
  // this lower line alias to upper line
  // return $delegates->sortByDesc('id');
});

Route::get('group', function () {
  $delegates = \App\Models\Delegate::all();
  return $delegates->groupBy('name');
});

Route::get('pop-pull-forget-every', function () {
  $delegates = \App\Models\Delegate::all();

  $delegate_pop = $delegates->pop();
  /* notice that if you use return keyword in same line of pop method this
   will not affect anything
   return $delegates->pop();

  but you should pop at the first then return all delegates again
  $delegates->pop();
  return $delegates;

  or you can get delegate which popped or removed then return this delegate
  $delegate = $delegates->pop();
  return $delegate;
  */

  /* difference between pop and pull that pull you specify key to remove it
   but pop remove last one always
  */

  $delegate_pull = $delegates->pull(2);

  // forget return all items except you specify
  $delegate_forget = $delegates->forget(2);

  /* here will see if all delegates have not null name if yes will return
   true else will return false
  */
  return $delegates->every(function ($delegate) {
    return $delegate->name != '';
  });
});
