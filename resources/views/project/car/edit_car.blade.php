@extends('layouts.app')

<title>Edit {{ $car->type }} | Delivery Management</title>

@section('ajax')
<script>
    $(document).ready(function() {
            $('#edit-ajax').on('click', function() {
                $.ajax({
                    type: 'patch',
                    url: '/index/ajax/car/' + $('#id').val(),
                    dataType: 'json',
                    data: $('form').serialize(),
                    success: function(data) {
                        if (data.status) {
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
<form action="/index/car/{{ $car->id }}" method="POST">
    @csrf
    @method('patch')
    <label>
        <span class="label-txt">ID Number</span>
        <input type="text" id="id" value="{{ $car->id }}" class="input text-center float-left text-red-700 font-bold"
            readonly>
        <div class="line-box">
            <div class="line"></div>
        </div>
    </label>
    <label>
        <span class="label-txt">Car Type</span>
        <input type="text" value="{{ $car->type ?? old('type') }}" name="type" class="input" autocomplete="off"
            placeholder="Enter Car Type">
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('type') <span class="float-left text-red-700 font-bold"> {{ $message }} </span> @enderror
    </label>
    <label>
        <span class="label-txt">Car Char</span>
        <input type="text" value="{{ $car->char ?? old('char') }}" name="char" class="input" autocomplete="off"
            placeholder="Enter Car Char" maxlength="3">
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('char') <span class="float-left text-red-700 font-bold"> {{ $message }} </span> @enderror
    </label>
    <label>
        <span class="label-txt">Car Number</span>
        <input type="text" value="{{ $car->number ?? old('number') }}" name="number" class="input" autocomplete="off"
            placeholder="Enter Car Number" maxlength="3">
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('number') <span class="float-left text-red-700 font-bold"> {{ $message }} </span> @enderror
    </label>
    <label>
        <div class="input-group">
            <select class="custom-select" name="mechanic_id">
                <option value="{{ $car->mechanic_id }}">{{ $car->mechanic->name }}</option>
                @foreach ($mechanics as $mechanic)
                <option value="{{ $mechanic->id }}">{{ $mechanic->name }}</option>
                @endforeach
            </select>
        </div>
        @error('mechanic_id') <span class="float-left text-red-700 font-bold"> {{ $message }} </span> @enderror
    </label>
    <input type="submit" value="Edit Data" class="btn btn-success">
    <input type="button" value="Edit Data Ajax" class="btn btn-success" id="edit-ajax">
</form>
@endsection