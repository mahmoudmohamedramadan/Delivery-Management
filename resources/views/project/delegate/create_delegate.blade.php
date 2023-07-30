@extends('layouts.app')

@section('title', 'Create Delegate | Delivery Management')

@section('ajax')
<script>
    $(document).ready(function() {
            $('#save-ajax').on('click', function(e) {
                const id = parseInt($('#id').val());
                const formData = new FormData($('#ajax')[0]);
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    encType: 'multipart/form-data',
                    url: "{{ url('/index/ajax/delegate') }}",
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: formData,
                    success: function(data) {
                        if (data.status) {
                            $('#flash-ajax').show();
                            $('#ajax')[0].reset();
                            $('#id').val(id + 1);
                            setTimeout(() => {
                                $('#flash-ajax').hide();
                            }, 6000);
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
@if ($cars->count() > 0)
<form id="ajax" action="/index/delegate" method="POST" enctype="multipart/form-data">
    @csrf
    <x-flash />
    <div class="alert alert-success" id="flash-ajax" style="display: none">
        <strong>Success</strong><br>
        <span>data saved successfully</span>
    </div>
    <label>
        <span class="label-txt">ID Number</span>
        <input type="text" id="id" value="{{ \App\Models\Delegate::max('id') + 1 }}"
            class="input text-red-700 text-center font-bold" readonly>
        <div class="line-box">
            <div class="line"></div>
        </div>
    </label>
    <label>
        <span class="label-txt">Delegate Name</span>
        <input type="text" value="{{ old('name') }}" name="name" class="input" autocomplete="off"
            placeholder="Enter Full Name">
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('name')
        <span class="float-left text-red-600 font-bold">{{ $message }}</span>
        @enderror
    </label>
    <label>
        <span class="label-txt">National ID</span>
        <input type="text" value="{{ old('national_id') }}" name="national_id" class="input" autocomplete="off"
            placeholder="Enter National ID" maxlength="16">
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('national_id')
        <span class="float-left text-red-600 font-bold">{{ $message }}</span>
        @enderror
    </label>
    <label>
        <span class="label-txt">Phone Number</span>
        <input type="text" value="{{ old('phone') }}" name="phone" class="input" autocomplete="off"
            placeholder="Enter Phone Number" maxlength="11">
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('phone')
        <span class="float-left text-red-600 font-bold">{{ $message }}</span>
        @enderror
    </label>
    <label>
        <span class="label-txt">Motor Size</span>
        <input type="text" value="{{ old('motor_size') }}" name="motor_size" class="input" autocomplete="off"
            placeholder="Enter Motor Size" maxlength="4">
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('motor_size')
        <span class="float-left text-red-600 font-bold">{{ $message }}</span>
        @enderror
    </label>
    <label>
        <div class="input-group">
            <select class="custom-select" name="car_id">
                @foreach ($cars as $car)
                <option value="{{ $car->id }}">{{ $car->type }}</option>
                @endforeach
            </select>
        </div>
    </label>
    <label>
        <span class="label-txt">Made Date</span>
        <input type="date" value="{{ old('made_date') }}" name="made_date" class="input cursor-pointer"
            autocomplete="off">
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('made_date')
        <span class="float-left text-red-700 font-bold">{{ $message }}</span>
        @enderror
    </label>
    <label>
        <div class="input-group">
            <span class="label-txt">Delegate Image</span>
            <input type="file" name="image" class="custom-file-input cursor-pointer">
            <div class="line-box">
                <div class="line"></div>
            </div>
        </div>
        @error('image')
        <span class="float-left text-red-700 font-bold">{{ $message }}</span>
        @enderror
    </label>
    <input type="submit" id="save" value="Save Data" class="btn btn-success">
    <input type="button" id="save-ajax" value="Save Ajax Data" class="btn btn-success">
</form>
<input type="button" value="Show Delegates Data" class="button btn btn-light"
    onclick="location.href= '/index/delegate' ">
<input type="button" value="Create Order" class="button btn btn-primary"
    onclick="location.href='/index/delegate-order/create' ">
<input type="button" value="Create Expense" class="button btn btn-primary"
    onclick="location.href='/index/expense/create' ">
@else
<div class="alert alert-warning">
    <strong>Warning</strong><br>
    <span>you can not visit this page until </span><a href="/index/car/create" class="underline">create
        a new car</a>
</div>
@endif
@endsection