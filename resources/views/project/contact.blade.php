@extends('layouts.app')
<title>{{ __('contact-us.Contact Us') }} | Delivery Management</title>
@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 30px;">
        <a class="navbar-brand" href="#" style="margin-left: 10px">Languages</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a rel="alternate" hreflang="{{ $localeCode }}"
                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                        class="content-center" style="margin-left: 20px">
                        {{ $properties['native'] }} </a>
                @endforeach
            </ul>
        </div>
    </nav>
    <form action="{{ url(LaravelLocalization::setLocale() . '/contact-us/submit') }}" method="POST">
        @csrf
        <x-flash />
        <label>
            <span class="label-txt">{{ __('contact-us.labels.Name') }}</span>
            <input type="text" class="input" value="{{ old('name') }}" name="name" autocomplete="off"
                placeholder="{{ __('contact-us.inputs.Name') }}">
            <div class="line-box">
                <div class="line"></div>
            </div>
            @error('name') <span class="text-red-600 font-bold">{{ $message }} </span> @enderror
        </label>
        <label>
            <span class="label-txt">{{ __('contact-us.labels.Email') }}</span>
            <input type="email" class="input" value="{{ old('email') }}" name="email"
                autocomplete="off" placeholder="{{ __('contact-us.inputs.Email') }}">
            <div class="line-box">
                <div class="line"></div>
            </div>
            @error('email') <span class="text-red-600 font-bold">{{ $message }} </span> @enderror
        </label>
        <label>
            <span class="label-txt">{{ __('contact-us.labels.Message') }}</span>
            <textarea name="message" class="input" style="max-height: 150px;min-height: 100px;"
                placeholder="{{ __('contact-us.inputs.Message') }}"></textarea>
            <div class="line-box">
                <div class="line"></div>
            </div>
            @error('message') <span class="label-txt text-red-600 font-bold"> {{ $message }}
            </span> @enderror
        </label>
        <input type="submit" value="Send Message" class="btn btn-success">
</form>
@endsection
