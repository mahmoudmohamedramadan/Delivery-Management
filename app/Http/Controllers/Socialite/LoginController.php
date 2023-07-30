<?php

namespace App\Http\Controllers\Socialite;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function redirectToProvider($service)
    {
        return Socialite::driver($service)->redirect();
    }

    public function handleProviderCallback($service)
    {
        return Socialite::driver($service)->user();
    }
}
