@extends('layouts.app')

@section('title', 'Login | Delivery Management')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
    crossorigin="anonymous">
<style>
    .separator {
        display: flex;
        align-items: center;
        text-align: center;
    }

    .separator::before,
    .separator::after {
        content: '';
        flex: 1;
        margin-right: 30px;
        margin-left: 40px;
        border-bottom: 1px solid #373A3C;
    }

    .separator::before {
        margin-right: 10px;
    }

    .separator::after {
        margin-left: 10px;
    }
</style>

@section('ajax')
<script>
    $(document).ready(function() {
            $('form').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route("login") }}',
                    type: 'post',
                    dataType: 'json',
                    data: $(this).serialize(),
                    success: function() {
                      top.location.href = '/index';
                      // $('#app').load('/index');
                      // window.history.pushState(null,'Main Page | Delivery Management','/index');
                      // document.title = 'Main Page | Delivery Management';
                    },
                    error: function(data) {
                        $.each(data['responseJSON'].errors, function(key, value) {
                            if (key == 'phone' || key == 'email' || key ==
                                'email_phone') {
                                $('#email_phone').empty().html(value);
                            } else {
                                $('#password').empty().html(value);
                            }
                        })
                    },
                });
            });
        });

</script>
@stop

@section('content')
<form action="">
    @csrf

    <label>
        <span class="label-txt">{{ __('E-Mail Address or Phone Number') }}</span>
        <input type="text" class="input" placeholder="Enter Email Or Phone Number" name="email_phone"
            value="{{ old('email_phone') }}" autocomplete="email_phone" autofocus>
        <div class="line-box">
            <div class="line"></div>
        </div>
        <span class="float-left text-red-700 font-bold" id="email_phone"></span>
    </label>

    <label>
        <span class="label-txt">{{ __('Password') }}</span>
        <input type="password" placeholder="Enter Password" class="input" name="password"
            autocomplete="current-password">
        <div class="line-box">
            <div class="line"></div>
        </div>
        <span class="float-left text-red-700 font-bold" id="password"></span>
    </label>
    <label style="display: inline;margin: 0;float: left">
        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <span for="remember">{{ __('Remember Me') }}</span>
    </label><br>
    <div style="margin-top: 30px">
        <button type="submit" class="btn btn-success">
            {{ __('Login') }}
        </button>
        @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
        @endif
    </div>
    <div style="margin-top: 10px">
        <h4 style="color:#373A3C;text-align:center" class="separator">
            or</h4>
    </div>
    <div class="mt-4">
        <button class="bg-blue-700 text-white rounded" style="width:150px;height:37px"
            onclick="location.href = 'login/facebook' ">
            <i class="fab fa-facebook-square mr-3"></i>Facebook
        </button>
        <button class="btn btn-danger rounded" style="width:150px;height:37px">
            <i class="fab fa-google mr-3"></i>Google
        </button>
    </div>
    <div class="mt-2">
        <button class="bg-blue-600 btn btn-primary rounded" style="width:150px;
                      height:37px">
            <i class="fab fa-linkedin mr-3"></i>LinkedIn
        </button>
        <button class="btn btn-dark rounded" style="width:150px;height:37px">
            <i class="fab fa-github mr-3"></i>GitHub
        </button>
    </div>
</form>
@endsection