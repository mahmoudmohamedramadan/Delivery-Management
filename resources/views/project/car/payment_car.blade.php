@extends('layouts.app')@section('title', 'Payment Car | Delivery Management')
@section('ajax')
  <script>
    $(document).ready(function () {
      $('#car-payment').on('click', function (e) {
        var price = $('#price').val();
        e.preventDefault();
        $.ajax({
                 type: 'GET',
                 url: '/index/car-payment/' + {{ request('id') }} +'/' + price +
                   '/form',
                 dataType: 'json',
                 data: {},
                 success: function (data) {
                   $('#payment-form').empty().html(data.content);
                 },
                 error: function (data) {
                   if (!data.status) {
                     $('#flash-ajax').show();
                     setTimeout(function () {
                       $('#flash-ajax').hide();
                     }, 6000);
                   }
                 }
               });
      });
    });
  </script>
@stop
@section('main')
  <form style="width: 80%;padding-bottom: 40px;padding-top: 40px">
    <a href="{{url('/index/car/create')}}"
       class="px-1 py-1 text-gray-500 cursor-pointer"><i
        class="fa fa-arrow-left" aria-hidden="true"
        style=";margin-top: -40px"></i></a>
    <div class="alert alert-danger" id="flash-ajax" style="display: none">
      <strong>Failure</strong><br>
      <span>invalid price</span>
    </div>
    @if (isset($error))
      <div class="alert alert-danger">
        <strong>Failure</strong><br>
        <span>{{ $error }}</span>
      </div>
    @else
      <label>
        <span class="label-txt">Price</span>
        <input type="text" value="{{ old('price') }}" name="price" id="price"
               class="input" autocomplete="off"
               placeholder="Enter Car Price In Dollar" maxlength="10">
        <div class="line-box">
          <div class="line"></div>
        </div>
      </label>
      <input type="button" value="Car Payment" class="btn btn-success"
             id="car-payment">
      <div id="payment-form" class="mt-3"></div>
    @endif
  </form>
@endsection
