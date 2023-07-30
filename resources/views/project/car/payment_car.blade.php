@extends('layouts.app')

@section('title', 'Payment Car | Delivery Management')

@section('ajax')
<script>
    $(document).ajaxStart(function() {
            $('#wait-msg').show();
        });
        $(document).ajaxComplete(function() {
            $('#wait-msg').hide();
        });
        $(document).ready(function() {
            $('#price').keyup(function() {
                // check if price not null and only numeric
                if ($(this).val() != '' && $.isNumeric($(this).val())) {
                    $('#buy').prop('disabled', false);
                    $('.price').empty();
                } else {
                    $('#buy').prop('disabled', true);
                    $('.price').html('price can not be null and should be numeric');
                }
            });
            $('form').on('submit', function(e) {
                var price = $('#price').val();
                e.preventDefault();
                $.ajax({
                    type: 'get',
                    url: '/index/car-payment/{{ request('id') }}/' + price + '/form',
                    dataType: 'json',
                    data: {},
                    success: function(data) {
                        $('#payment-form').empty().html(data.content);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
        });
</script>
@stop
@section('content')
<div id="wait-msg" style="display: none;position:absolute;z-index:
                100000;margin-top: 330px;margin-left: 530px" class="spinner-border text-primary" role="status"></div>
<form style="width: 80%;padding-bottom: 40px;padding-top: 40px">
    <a href="{{ url('/index/car/create') }}" class="px-1 py-1 text-gray-500 cursor-pointer">
        <i class="fa fa-arrow-left" aria-hidden="true" style=";margin-top: -40px"></i>
    </a>
    <div id="flash-msg" class="alert alert-danger mt-3" style="display: none">
        <strong>Success</strong><br>
        <span>success transaction</span>
    </div>
    <label>
        <span class="label-txt">Price</span>
        <input type="text" value="{{ old('price') }}" name="price" id="price" class="input" autocomplete="off"
            placeholder="Enter Car Price" maxlength="7">
        <div class="line-box">
            <div class="line"></div>
        </div>
        <span class="price float-left text-red-700 font-bold"></span>
    </label>
    <input type="submit" value="Buy" class="btn btn-success" id="buy" disabled>
    <div id="payment-form" class="mt-3"></div>
</form>
@endsection