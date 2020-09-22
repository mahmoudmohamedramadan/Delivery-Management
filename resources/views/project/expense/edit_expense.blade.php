@extends('layouts.app')<title>Edit {{ $expense->type }} | Delivery
  Management</title>
@section('ajax')
  <script>
    $(document).ready(function () {
      $('#ajax').submit(function (e) {
        e.preventDefault();
        $.ajax({
                 type: 'patch',
                 url: '/index/expense/' + {{ $expense->id }},
                 dataType: 'json',
                 processData: false,
                 data: $('#ajax').serialize(),
                 success: function () {
                   top.location.href = '/index/expense/' + {{ $expense->id }};
                 },
                 error: function (data) {
                   console.log(data);
                 }
               });
      });
    });
  </script>
@stop
@section('content')
  <form id="ajax">
    @csrf
    @method('patch')
    <x-flash/>
    <label>
      <span class="label-txt">Expense Number</span>
      <input type="text" value="{{ $expense->id ?? old('id') }}" name="id"
             class="input text-center text-red-700 font-bold" readonly>
      <div class="line-box">
        <div class="line"></div>
      </div>
      @error('id')<span
        class="text-red-600 font-bold float-left">{{ $message }}</span>@enderror
    </label>
    <label>
      <span class="label-txt">Expense Type</span>
      <input type="text" value="{{ $expense->type ?? old('type') }}" name="type"
             class="input" placeholder="Enter Expense Type">
      <div class="line-box">
        <div class="line"></div>
      </div>
      @error('type')<span
        class="text-red-600 font-bold float-left">{{ $message }}</span>@enderror
    </label>
    <label>
      <span class="label-txt">Expense Information</span>
      <input type="text" value="{{ $expense->info ?? old('info') }}" name="info"
             class="input" placeholder="Enter Expense Information">
      <div class="line-box">
        <div class="line"></div>
      </div>
      @error('info')<span
        class="text-red-600 font-bold float-left">{{ $message }}</span>@enderror
    </label>
    <label>
      <span class="label-txt">Sum</span>
      <input type="text" value="{{ $expense->sum ?? old('sum') }}" name="sum"
             class="input" placeholder="Enter Sum Of Expense" max="4">
      <div class="line-box">
        <div class="line"></div>
      </div>
      @error('sum')<span
        class="text-red-600 font-bold float-left">{{ $message }}</span>@enderror
    </label>
    <label>
      <span class="label-txt">Notes</span>
      <textarea name="notes" placeholder="Enter Expense Notes" class="input"
                style="min-height: 100px;max-height: 200px">{{ $expense->notes ?? old('notes') }}</textarea>
      <div class="line-box">
        <div class="line"></div>
      </div>
      @error('notes')<span
        class="text-red-600 font-bold float-left">{{ $message }}</span>@enderror
    </label>
    <div class="mt-10">
      <button class="btn btn-success"
              onclick="location.href= '/index/expense/{{ $expense->id }}' ">Edit
        Data
      </button>
      <button type="submit" class="btn btn-success">Edit Data Ajax</button>
    </div>
  </form>
@endsection
