@extends('layouts.app')<title>Edit {{ $mechanic->name }} | Delivery
  Management</title>
@section('ajax')
  <script>
    $(document).ready(function () {
      $('#edit-ajax').on('click', function (e) {
        const id = $('#id').val();
        e.preventDefault();
        $.ajax({
                 type: 'patch',
                 url: '/index/ajax/mechanic/' + id,
                 dataType: 'json',
                 data: $('#ajax').serialize(),
                 success: function (data) {
                   if (data.status) {
                     top.location.href = '/index/mechanic';
                   }
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
  <form id="ajax" action="/index/mechanic/{{ $mechanic->id }}" method="post">
    @csrf
    @method('patch')
    <x-flash/>
    <label>
      <span class="label-txt">ID Number</span>
      <input id="id" type="text" value="{{ $mechanic->id ?? old
      ('id') }}" name="id" class="input text-red-700
      text-center font-bold" readonly>
      <div class="line-box">
        <div class="line"></div>
      </div>
    </label>
    <label>
      <span class="label-txt">Mechanic Name</span>
      <input type="text" class="input"
             value="{{ $mechanic->name ?? old('name') }}" name="name"
             autocomplete="off" placeholder="Enter Mechanic Name">
      <div class="line-box">
        <div class="line"></div>
      </div>
      @error('name')
      <span
        class="text-red-600 font-bold float-left">{{ $message }}</span>@enderror
    </label>
    <label>
      <span class="label-txt">Mechanic Address</span>
      <textarea name="address" class="input"
                style="min-height: 100px;max-height: 200px" placeholder="Mechanic
                Address">{{$mechanic->address ?? old('address') }}</textarea>
      <div class="line-box">
        <div class="line"></div>
      </div>
      @error('address')
      <span
        class="text-red-600 font-bold float-left">{{ $message }}</span>@enderror
    </label>
    <input type="submit" value="Edit Data" class="btn btn-success">
    <button id="edit-ajax" class="btn btn-success">Edit Ajax Data</button>
  </form>
@endsection
