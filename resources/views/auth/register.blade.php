@extends('layouts.app')

@section('title', 'Register | Delivery Management')

{{-- @section('ajax')
    <script>
        $(document).on('submit', 'form', function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('register') }}',
                type: 'get',
                dataType: 'json',
                data: $(this).serialize(),
                success: function(data) {
                    top.location.href = '/index';
                },
                error: function(data) {
                    var inputsID = ['name', 'email', 'phone', 'password'];
                    $.each(inputsID, function(index, id) {
                        $.each(data['errors'][id], function(key, value) {
                            $('#' + id).empty().html(value);
                        });
                    });
                }
            });
        });
    </script>
@stop --}}

@section('content')
    <form action="{{ route('register') }}" method="POST">
        @csrf

        <label>
            <span for="name" class="label-txt">{{ __('Name') }}</span>
            <input id="name" type="text" class="input" name="name" value="{{ old('name') }}"
                placeholder="Enter Name" autocomplete="name" autofocus>
            <div class="line-box">
                <div class="line"></div>
            </div>
            <span class="d-flex justify-content-start text-danger">{{ $errors->first('name') }}</span>
        </label>
        <label>
            <span for="email" class="label-txt">{{ __('E-Mail Address') }}</span>
            <input id="email" type="email" class="input" name="email" value="{{ old('email') }}"
                placeholder="Enter Email" autocomplete="email">
            <div class="line-box">
                <div class="line"></div>
            </div>
            <span class="d-flex justify-content-start text-danger">{{ $errors->first('email') }}</span>
        </label>
        <label>
            <span for="phone" class="label-txt">{{ __('Phone Number') }}</span>
            <input id="phone" type="text" class="input" name="phone" value="{{ old('phone') }}"
                placeholder="Enter PhoneNumber" autocomplete="phone">
            <div class="line-box">
                <div class="line"></div>
            </div>
            <span class="d-flex justify-content-start text-danger">{{ $errors->first('phone') }}</span>
        </label>
        <label>
            <span for="password" class="label-txt">{{ __('Password') }}</span>
            <input id="password" type="password" class="input" name="password" placeholder="Enter Password"
                autocomplete="new-password">
            <div class="line-box">
                <div class="line"></div>
            </div>
            <span
                class="d-flex justify-content-start d-flex justify-content-start text-danger">{{ $errors->first('password') }}</span>
        </label>
        <label>
            <span for="password-confirm" class="label-txt">{{ __('Confirm Password') }}</span>
            <input id="password-confirm" type="password" class="input" name="password_confirmation"
                placeholder="Enter Password Confirmation" autocomplete="new-password">
            <div class="line-box">
                <div class="line"></div>
            </div>
            <span class="d-flex justify-content-start text-danger">{{ $errors->first('password_confirmation') }}</span>
        </label>
        <button type="submit" class="btn btn-success">
            {{ __('Register') }}
        </button>
    </form>
@endsection
