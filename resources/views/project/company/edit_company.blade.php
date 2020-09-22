@extends('layouts.app')
<title>Edit {{ $company->name }} | Delivery Management</title>
@section('ajax')
    <script>
        $(document).ready(function() {
            $('#ajax').submit(function(e) {
                const formData = $(this).serialize();
                const companyId = $('input[name=id]').val();
                e.preventDefault();
                $.ajax({
                    type: 'patch',
                    url: '/index/ajax/company/' + companyId,
                    dataType: 'json',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        top.location.href = '/index/ajax/company';
                    },
                    error: function(data) {
                        $('#flash-ajax').show();
                        setTimeout(function() {
                            $('#flash-ajax').hide();
                        }, 6000);
                    }
                });
            });
        });

    </script>
@stop
@section('content')
    <form id="ajax" method="post">
        @csrf
        @method('patch')
        <div class="alert alert-danger" id="flash-ajax" style="display: none">
            <strong>Failuer</strong><br>
            <span>An error has occurred</span>
        </div>
        <label>
            <span class="label-txt">ID Number</span>
            <input type="text" name="id" value="{{ $company->id }}" class="input text-center text-red-700 font-bold"
                readonly>
            <div class="line-box">
                <div class="line"></div>
            </div>
        </label>
        <label>
            <span class="label-txt">Company Name</span>
            <input type="text" value="{{ $company->name ?? old('type') }}" name="name" class="input" autocomplete="off"
                placeholder="Enter Company Name">
            <div class="line-box">
                <div class="line"></div>
            </div>
            @error('name') <span class="text-red-700 font-bold">{{ $message }}</span>@enderror
        </label>
        <label>
            <span class="label-txt">Manager Name</span>
            <input type="text" value="{{ $company->manager ?? old('manager') }}" name="manager" class="input"
                autocomplete="off" placeholder="Enter Manager Name">
            <div class="line-box">
                <div class="line"></div>
            </div>
            @error('manager') <span class="text-red-700 font-bold">{{ $message }}</span>@enderror
        </label>
        <label>
            <span class="label-txt">Address</span>
            <input type="text" value="{{ $company->address ?? old('address') }}" name="number" class="input"
                autocomplete="off" placeholder="Enter Compnay Address">
            <div class="line-box">
                <div class="line"></div>
            </div>
            @error('address') <span class="text-red-700 font-bold"> {{ $message }} </span> @enderror
        </label>
        <label>
            <span class="label-txt">Email</span>
            <input type="email" value="{{ $company->email ?? old('email') }}" name="email" class="input" autocomplete="off"
                placeholder="Enter Compnay Email">
            <div class="line-box">
                <div class="line"></div>
            </div>
            @error('email') <span class="text-red-700 font-bold"> {{ $message }} </span> @enderror
        </label>
        <label>
            <span class="label-txt">Phone Number</span>
            <input type="test" value="{{ $company->phone ?? old('phone') }}" name="phone" class="input" autocomplete="off"
                placeholder="Enter Phone Number" maxlength="11">
            <div class="line-box">
                <div class="line"></div>
            </div>
            @error('phone') <span class="text-red-700 font-bold"> {{ $message }} </span> @enderror
        </label>
        <label>
            <span class="label-txt">Product Name</span>
            <input type="text" value="{{ $company->product_name ?? old('product_name') }}" name="product_name" class="input"
                autocomplete="off" placeholder="Enter Product Name">
            <div class="line-box">
                <div class="line"></div>
            </div>
            @error('product_name') <span class="text-red-700 font-bold"> {{ $message }} </span> @enderror
        </label>
        <label>
            <span class="label-txt">Product Quantity</span>
            <input type="text" value="{{ $company->quantity ?? old('quantity') }}" name="quantity" class="input"
                autocomplete="off" placeholder="Enter Product Quantity" maxlength="4">
            <div class="line-box">
                <div class="line"></div>
            </div>
            @error('quantity') <span class="text-red-700 font-bold"> {{ $message }} </span> @enderror
        </label>
        <input type="submit" value="Edit Data" class="btn btn-success">
    </form>
@endsection
