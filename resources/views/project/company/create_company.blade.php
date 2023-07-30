@extends('layouts.app')

@section('title', 'Create Company | Delivery Management')

@push('scripts')
<script>
    $(document).ready(function() {
            $('#save-data').on('click', function(e) {
                const formData = new FormData($('#ajax')[0]);
                e.preventDefault();
                $.ajax({
                    type: 'post'
                    url: '/index/ajax/comppany',
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'companyData': formData
                    },
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
        });
</script>
@endpush

@section('content')
<form id="ajax">
    @csrf
    <div class="alert alert-success" id="flash-ajax" style="display: none">
        <strong>Success</strong><br>
        <span>data saved successfully</span>
    </div>
    <label>
        <input type="hidden" id="_token" value='{{ csrf_token() }}'>
        <span class="label-txt">ID Number</span>
        <input type="text" value="{{ \App\Models\Company::max('id') + 1 }}"
            class="input text-center text-red-700 font-bold" readonly>
        <div class="line-box">
            <div class="line"></div>
        </div>
    </label>
    <label>
        <span class="label-txt">Company Name</span>
        <input type="text" value="{{ old('type') }}" name="name" class="input" autocomplete="off"
            placeholder="Enter Company Name">
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('name') <span class="text-red-700 font-bold">{{ $message }}</span>@enderror
    </label>
    <label>
        <span class="label-txt">Manager Name</span>
        <input type="text" value="{{ old('manager') }}" name="manager" class="input" autocomplete="off"
            placeholder="Enter Manager Name">
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('manager') <span class="text-red-700 font-bold">{{ $message }}</span>@enderror
    </label>
    <label>
        <span class="label-txt">Address</span>
        <input type="text" value="{{ old('address') }}" name="number" class="input" autocomplete="off"
            placeholder="Enter Compnay Address">
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('address') <span class="text-red-700 font-bold"> {{ $message }} </span> @enderror
    </label>
    <label>
        <span class="label-txt">Email</span>
        <input type="email" value="{{ old('email') }}" name="email" class="input" autocomplete="off"
            placeholder="Enter Compnay Email">
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('email') <span class="text-red-700 font-bold"> {{ $message }} </span> @enderror
    </label>
    <label>
        <span class="label-txt">Phone Number</span>
        <input type="text" value="{{ old('phone') }}" name="phone" class="input" autocomplete="off"
            placeholder="Enter Phone Number" maxlength="11">
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('phone') <span class="text-red-700 font-bold"> {{ $message }} </span> @enderror
    </label>
    <label>
        <span class="label-txt">Product Name</span>
        <input type="text" value="{{ old('product_name') }}" name="product_name" class="input" autocomplete="off"
            placeholder="Enter Product Name">
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('product_name') <span class="text-red-700 font-bold"> {{ $message }} </span> @enderror
    </label>
    <label>
        <span class="label-txt">Product Quantity</span>
        <input type="text" value="{{ old('quantity') }}" name="quantity" class="input" autocomplete="off"
            placeholder="Enter Product Quantity" maxlength="4">
        <div class="line-box">
            <div class="line"></div>
        </div>
        @error('quantity') <span class="text-red-700 font-bold"> {{ $message }} </span> @enderror
    </label>
    <input type="button" value="Save Data" class="btn btn-success" id="save-ajax">
</form>
<input type="button" value="Show Companies Data" class="button btn btn-light"
    onclick="location.href= '/index/ajax/company' ">
@endsection