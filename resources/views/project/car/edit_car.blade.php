@extends('layouts.app')
<title>Edit {{ $car->car_type }} | Delivery Management</title>
@section('ajax')
<script>
    $(document).ready(function(){
        $('#save-ajax').on('click',function(e){
            var id = parseInt( $('#id').val() );
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/index/ajax/car'
                dataType: 'json',
                data: ('#ajax').serialize(),
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    if(data.status){
                       top.location.href = '/index/car';
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
<div>
    <form id="ajax" action="/index/car/{{ $car->id }}" method="POST">
        @csrf
        @method('PATCH')
        <fieldset class="flex justify content-center border border-gray-400 p-10 mb-10 ml-1 mr-1">
            <legend class="border border-gray-400 p-3 mb-3 text-center">Edit Car Inforamtion</legend>
            <x-flash/>
            <span>ID Number</span>
            <input id="id" type="text" value="{{ $car->id ?? old('id_number') }}" name="id_number" class="mt-2 py-1 px-1 text-red-600 font-bold border border-gray-400" style="text-align:center;width: 200px" readonly>
            <br><span>Car Type</span>
            <input type="text" value="{{ $car->car_type ?? old('car_type') }}" name="car_type" class="mt-2 py-1 px-1 border border-gray-400" style="width: 400px" autocomplete="off" placeholder="Enter Car Type">
            @error('car_type') <span class="text-red-600 font-bold"> {{ $message }} </span> @enderror
            <br><span>Car Char</span>
            <input type="text" value="{{ $car->car_char ?? old('car_char') }}" name="car_char" class="mt-2 py-1 px-1 border border-gray-400" style="width: 200px" autocomplete="off" placeholder="Enter Car Char">
            @error('car_char') <span class="text-red-600 font-bold"> {{ $message }} </span> @enderror
            <br><span>Car Number</span>
            <input type="text" value="{{ $car->car_number ?? old('car_number') }}" name="car_number" class="mt-2 py-1 px-1 border border-gray-400" style="width: 200px" autocomplete="off" placeholder="Enter Car Number">
            @error('car_number') <span class="text-red-600 font-bold"> {{ $message }} </span> @enderror
            <div class="mt-10">
                <input type="submit" value="Edit Data" class="btn btn-primary" style="width: 200px">
                <button id="save-ajax" class="btn btn-primary" style="width: 200px">Edit Ajax Data</button>
            </div>
        </fieldset>
    </form>
</div>
@endsection
