<?php

namespace App\Http\Controllers\Contact;

use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;

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
