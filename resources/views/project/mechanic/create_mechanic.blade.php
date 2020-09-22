@extends('layouts.app')@section('title', 'Create Mechanic | Delivery Management')
@section('ajax')
    <script>
        $(document).ready(function() {
            $('#save-ajax').on('click', function(e) {
                const id = parseInt($('#id').val());
                const formData = new FormData($('#ajax')[0]);
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: "{{ url('/index/ajax/mechanic') }}",
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
                        }
                    },
                    error: function(data) {
                        const errors = data['responseJSON'].errors;
                        $.each(errors, function(key, value) {
                            console.log(key + " >> " + value[0]);
                        });
                    }
                });
            });
        });

    </script>
@stop
@section('content')
    <form id="ajax" action="/index/mechanic" method="POST">
        @csrf
        <x-flash />
        <div class="alert alert-success" id="flash-ajax" style="display: none">
            <strong>Success</strong><br>
            <span>data saved successfully</span>
        </div>
        <label>
            <span class="label-txt">ID Number</span>
            <input type="text" id="id" name="id" value="{{ \App\Models\Mechanic::max('id') + 1 }}"
                class="input text-center text-red-700 font-bold" readonly>
            <div class="line-box">
                <div class="line"></div>
            </div>
        </label>
        <label>
            <span class="label-txt">Mechanic Name</span>
            <input type="text" value="{{ old('name') }}" name="name" class="input" autocomplete="off"
                placeholder="Enter Mechanic Name">
            <div class="line-box">
                <div class="line"></div>
            </div>
            @error('name')
            <span class="text-red-600 font-bold float-left">{{ $message }}</span>@enderror
        </label>
        <label>
            <span class="label-txt">Mechanic Address</span>
            <textarea name="address" value="{{ old('address') }}" class="input" style="min-height: 100px;max-height: 200px"
                placeholder="Enter Mechanic Address"></textarea>
            <div class="line-box">
                <div class="line"></div>
            </div>
            @error('address')
            <span class="text-red-600 font-bold float-left">{{ $message }}</span>@enderror
        </label>
        <input type="submit" value="Save Data" class="btn btn-success">
        <input type="button" id="save-ajax" value="Save Ajax Data" class="btn btn-success">
    </form>
    <label style="position:absolute;bottom: 0">
        <input type="button" value="Show Mechanics Data" class="button btn btn-light"
            onclick="location.href= '/index/mechanic' ">
        <input type="button" value="Create Car" class="button btn btn-primary"
            onclick="location.href= '/index/car/create' ">
    </label>
@endsection
