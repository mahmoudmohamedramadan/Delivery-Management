@extends('layouts.app')@section('title', 'Create Delegate\'s Order | Delivery Management')
@section('ajax')
  <script>
    $(document).ready(function () {
      $('#save-ajax').on('click', function (e) {
        const id = parseInt($('#id').val());
        const formData = new FormData($('#ajax')[0]);
        e.preventDefault();
        $.ajax({
                 type: 'POST',
                 url: "{{ url('/index/ajax/delegate-order') }}",
                 dataType: 'json',
                 data: formData,
                 processData: false,
                 contentType: false,
                 cache: false,
                 success: function (data) {
                   if (data.status) {
                     $('#flash-ajax').show();
                     $('#ajax')[0].reset();
                     $('#id').val(id + 1);
                     setTimeout(() => {
                       $('#flash-ajax').hide();
                     }, 6000);
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
  <form id="ajax" action="{{ action('Order\OrderController@store') }}"
        method="POST">
    @csrf
    <x-flash/>
    <div class="alert alert-success" style="display: none" id="flash-ajax">
      <strong>Success</strong><br>
      <span>data saved successfully</span>
    </div>
    <label>
      <span class="label-txt">ID Number</span>
      <input id="id" type="text" value="{{ \App\Models\Order::max('id') + 1 }}"
             name="id" class="input text-red-700 text-center font-bold"
             readonly>
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
        @error('delegate_id') <span
          <span class="text-red-600 font-bold float-left">{{ $message }}</span>@enderror
      </div>
    </label>
    <label>
      <span class="label-txt">Shop Name</span>
      <input type="text" name="shop_name" value="{{ old('shop_name') }}"
             placeholder="Enter Shop Name" class="input" autocomplete="off">
      <div class="line-box">
        <div class="line"></div>
      </div>
      @error('shop_name') <span
        <span class="text-red-600 font-bold float-left"> {{ $message }} </span> @enderror
    </label>
    <label>
      <span class="label-txt">Customer Address</span>
      <input type="text" name="customer_address"
             value="{{ old('customer_address') }}"
             placeholder="Enter Customer Address" class="input"
             autocomplete="off">
      <div class="line-box">
        <div class="line"></div>
      </div>
      @error('customer_address') <span class="text-red-700 font-bold"
                                       autocomplete="off"> {{ $message }} </span>
      @enderror
    </label>
    <label>
      <span class="label-txt">Phone Number</span>
      <input type="text" name="phone" value="{{ old('phone') }}"
             placeholder="Enter Phone Number" class="input" autocomplete="off"
             maxlength="11">
      <div class="line-box">
        <div class="line"></div>
      </div>
      @error('phone') <span
        <span class="text-red-600 font-bold float-left"> {{ $message }} </span> @enderror
    </label>
    <label>
      <div class="input-group">
        <select class="custom-select" name="order_fees">
          <option value="1">0.5</option>
          <option value="2">0.75</option>
          <option value="3">0.0</option>
        </select>
        @error('order_fees') <span
          <span class="text-red-600 font-bold float-left"> {{ $message }} </span> @enderror
      </div>
    </label>
    <label>
      <span class="label-txt">Delivery Value</span>
      <input type="text" placeholder="Enter Delivery Value"
             name="delivery_value" value="{{ old
            ('delivery_value') }}" class="input" maxlength="4"
             autocomplete="off">
      <div class="line-box">
        <div class="line"></div>
      </div>
      @error('delivery_value') <span
        <span class="text-red-600 font-bold float-left"> {{ $message }} </span> @enderror
    </label>
    <label>
      <span class="label-txt">Delivery Date</span>
      <input type="date" value="{{ old('delivery_date') }}" name="delivery_date"
             class="input cursor-pointer" autocomplete="off">
      <div class="line-box">
        <div class="line"></div>
      </div>
      @error('made_date') <span
        <span class="text-red-600 font-bold float-left"> {{ $message }} </span> @enderror
    </label>
    <input type="submit" value="Save Data" class="btn btn-success">
    <input type="button" value="Save Data Ajax" class="btn btn-success"
           id="save-ajax">
  </form>
  <input type="button" value="Show Orders Data" class="button btn btn-light"
         onclick="location.href= '/index/delegate-order' ">
@endsection
