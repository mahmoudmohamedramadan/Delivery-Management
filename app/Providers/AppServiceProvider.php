<?php

namespace App\Providers;

use App\Http\View\Composers\OrderComposer;
use App\Models\Delegate;
use App\Models\Mechanic;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // get delegates data using query builder
        $delegates = Delegate::get();
        // get mechanics data
        $mechanics = Mechanic::all();

        // here i will share delegates key in all views which value is $delegates
        View::share('delegates', $delegates);
        /* here i will share mechanics key in specific views passed in array and
        using wildcard means i will pass this key in all views in this
        path[project.mechanic]
         */
        View::composer(['project.mechanic.index_mechanic'], function ($view) use ($mechanics) {
            $view->with('mechanics', $mechanics);
        });

        // using wild card
        View::composer(['project.*', 'layouts.app'], function ($view) {
            $user = new \App\User();
            if ($user->hasMedia('avatar')) {
                $avatar = auth()->user()->getMedia('avatar');
                $view->with('avatar', $avatar);
            } else {
                $view->with('avatar', '');
            }
        });

        View::composer(['project.order.*'], OrderComposer::class);
    }
}
