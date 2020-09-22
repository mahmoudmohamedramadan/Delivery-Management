@extends('layouts.app')<title>Edit {{ $order->delegate->name }}'s Order | Delivery
  Management</title>
@section('ajax')
  <script>
    $(document).ready(function () {
      $('#edit-ajax').on('click', function (e) {
        var id = $('#id').val();
        e.preventDefault();
        $.ajax({
                 type: 'PATCH',
                 url: '/index/ajax/delegate-order/' + id,
                 dataType: 'json',
                 data: $('#ajax').serialize(),
                 success: function (data) {
                   if (data.status) {
                     top.location.href = '/index/delegate-order';
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
  <form id="ajax"
        action="{{ action('Order\OrderController@update', ['id' => $order->id]) }}"
        method="POST">
    @csrf
    @method('PATCH')
    <x-flash/>
    <label>
      <span class="label-txt">Order Number</span>
      <input type="text" value="{{ $order->id ?? old('id') }}" id="id"
             class="input text-center text-red-600 font-bold" readonly>
      <div class="line-box">
        <div class="line"></div>
      </div>
    </label>
    <label>
      <div class="input-group">
        <select class="custom-select" name="delegate_id">
          @foreach ($delegates as $delegate)
            <option value="{{ $delegate->id }}">{{ $delegate->name }}</option>
          @endforeach
        </select>
      </div>
      @error('delegate_id')<span
        class="text-red-600 font-bold"> {{ $message }}</span>@enderror
    </label>
    <label>
      <span class="label-txt">Shop Name</span>
      <input type="text" name="shop_name"
             value="{{ $order->shop_name ?? old('shop_name') }}"
             placeholder="Enter Shop Name" class="input" autocomplete="off">
      <div class="line-box">
        <div class="line"></div>
      </div>
      @error('shop_name')<span class="text-red-600 font-bold float-left">{{ $message }}</span>@enderror
    </label>
    <label>
      <span class="label-txt">Customer Address</span>
      <input type="text" name="customer_address"
             value="{{ $order->customer_address ?? old('customer_address') }}"
             placeholder="Enter Shop Name" class="input">
      <div class="line-box">
        <div class="line"></div>
      </div>
      @error('customer_address')<span class="text-red-600 font-bold float-left">{{ $message }}</span>@enderror
    </label>
    <label>
      <span class="label-txt">Phone Number</span>
      <input type="text" name="phone"
             value="{{ $order->phone ?? old('phone') }}"
             placeholder="Enter Phone Number" class="input" autocomplete="off">
      <div class="line-box">
        <div class="line"></div>
      </div>
      @error('phone')<span class="text-red-600 font-bold float-left">{{ $message
      }}</span>@enderror
    </label>
    <label>
      <div class="input-group">
        <select class="custom-select" name="order_fees">
          <option value="1">0.75</option>
          <option value="2">0.5</option>
          <option value="3">0.0</option>
        </select>
      </div>
      @error('order_fees')<span
        class="text-red-600 font-bold"> {{ $message }}</span>@enderror
    </label>
    <label>
      <span class="label-txt">Delivery Value</span>
      <input type="text" name="delivery_value"
             value="{{ $order->delivery_value ?? old('delivery_value') }}"
             class="input" autocomplete="off">
      <div class="line-box">
        <div class="line"></div>
      </div>
      @error('delivery_value')<span class="text-red-600 font-bold float-left">{{ $message }}</span>@enderror
    </label>
    <label>
      <span class="label-txt">Delivery Date</span>
      <input type="date" value="{{ $order->delivery_date ?? old('delivery_date')
      }}" name="delivery_date" class="input cursor-pointer" autocomplete="off">
      <div class="line-box">
        <div class="line"></div>
      </div>
      @error('delivery_date')
      <span class="text-red-700 font-bold">{{ $message }}</span>@enderror
    </label>
    <input type="submit" value="Edit Data" class="btn btn-success">
    <input type="button" id="edit-ajax" value="Edit Ajax Data"
           class="ml-1 btn btn-success">
  </form>
@endsection
