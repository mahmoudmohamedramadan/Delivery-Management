@extends('layouts.app')

@section('title', 'Create Car | Delivery Management')

@section('ajax')
<script>
    $(document).ready(function() {
            $('#save-ajax').on('click', function(e) {
                const id = parseInt($('#id').val());
                const formData = new FormData($('#ajax')[0]);
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: "{{ url('/index/ajax/car') }}",
                    dataType: 'json',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(data) {
                        if (data.status) {
                            $('#flash-ajax').show();
                            $('#ajax')[0].reset();
                            $('#id').val(id + 1);
                            setTimeout(() => {
                                $('#flash-ajax').hide();
                            }, 6000);
                            top.location.href = '/index/car/create';
                        }
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
@if (!$error && !$payment_error)
<form action="/index/car" method="POST" id="ajax">
    @csrf
    <div class="alert alert-success" id="flash-ajax" style="display: none">
        <strong>Success</strong><br>
        <span>data saved successfully</span>
    </div>
    <label>
        <span class="label-txt">ID Number</span>
        <input id="id" type="text" value="{{ \App\Models\Car::max('id') + 1 }}" name="id_number"
            class="input text-center text-red-700 font-bold" readonly>
        <div class="line-box">
            <div class="line"></div>
        </div>
    </label>
    <label>
        <span class="label-txt">Car Type</span>
        <input type="text" value="{{ old('type') }}" name="type" class="input" autocomplete="off"
            placeholder="Enter Car Type">
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('type') <span class="float-left text-red-700 font-bold"> {{ $message }} </span> @enderror
    </label>
    <label>
        <span class="label-txt">Car Char</span>
        <input type="text" value="{{ old('char') }}" name="char" class="input" autocomplete="off"
            placeholder="Enter Car Char" maxlength="3">
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('char') <span class="float-left text-red-700 font-bold"> {{ $message }} </span> @enderror
    </label>
    <label>
        <span class="label-txt">Car Number</span>
        <input type="text" value="{{ old('number') }}" name="number" class="input" autocomplete="off"
            placeholder="Enter Car Number" maxlength="3">
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('number') <span class="float-left text-red-700 font-bold"> {{ $message }} </span> @enderror
    </label>
    <label>
        <div class="input-group">
            <select class="custom-select" name="mechanic_id">
                @foreach ($mechanics as $mechanic)
                <option value="{{ $mechanic->id }}">{{ $mechanic->name }}</option>
                @endforeach
            </select>
        </div>
        @error('mechanic_id') <span class="float-left text-red-700 font-bold"> {{ $message }} </span>
        @enderror
    </label>
    <input type="submit" value="Save Data" class="btn btn-success">
    <input type="button" value="Save Data Ajax" class="btn btn-success" id="save-ajax">
</form>
<input type="button" value="Show Cars Data" class="button btn btn-light" onclick="location.href= '/index/car' ">
@elseif($payment_error && !$error)
<div class="alert alert-warning">
    <strong>Warning</strong><br>
    <span>you can not visit this page untill go to <a href="/index/car-payment/{{ \App\Models\Car::max('id') + 1 }}"
            class="underline">payment
            ways</a></span>
</div>
@else
<div class="alert alert-warning">
    <strong>Warning</strong><br>
    <span>you can not use this page untill </span><a href="/index/mechanic/create" class="underline">create a
        new
        mechanic</a>
</div>
@endif
@endsection