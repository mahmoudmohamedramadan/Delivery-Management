<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','Main Page | Delivery Management')</title>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('js/project_layout.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/project_layout.css') }}">

    @yield('ajax')
    @livewireStyles
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand text-lg" href="{{ url('/') }}">
                    Delivery Management
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <div class="mt-2">
                            <a href="{{ url('/index/delegate/create') }}" class="mr-2">Create
                                Delegate</a>
                            <a href="{{ action('Company\CompanyAjaxController@create') }}" class="mr-2">Create
                                Company</a>
                            <a href="/index/mechanic/create" class="mr-2">Create Mechanic</a>
                            <a href='{{ url(' /index/settings/' . auth()->user()->id) }}'
                                style="margin-right: 5px;margin-top: 5px">Settings</a>
                        </div>
                        <a class="nav-link nav-link-label" href="/index/{{ Auth::Id() }}/notifications">
                            <i class="fa fa-bell"></i>
                            <span
                                class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow notify-count"
                                data-count="0">{{ Auth::user()->unreadNotifications()->count() }}</span>
                        </a>
                        <li class="nav-item dropdown" style="direction: rtl">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                                @if ($avatar[0])
                                <img src="{{ asset($avatar[0]->getUrl()) }}" alt="avatar" width="25px" height="25px"
                                    style="display: inline;border-radius: 50%;margin-top: -3px">
                                @else
                                <img src="http://placehold.it/100/100" alt=" avatar" width="25px" height="25px"
                                    style="display: inline;border-radius: 50%;margin-top: -5px">
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/index">
                                    Home Page
                                </a>
                                <a class="dropdown-item" href="/index/settings/edit-profile">
                                    Edit Profile
                                </a>
                                <a class="dropdown-item"
                                    href="{{ url(LaravelLocalization::setLocale() . '/contact-us') }}">
                                    Contact Us
                                </a>
                                <hr>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
    @livewireScripts
    @include('sweetalert::alert')
</body>

</html>