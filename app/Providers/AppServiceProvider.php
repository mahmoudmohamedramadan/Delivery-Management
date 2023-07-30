<?php

namespace App\Providers;

use App\Models\Delegate;
use App\Models\Mechanic;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\OrderComposer;

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
        // if (Schema::hasTable('delegates') && Schema::hasTable('mechanics') && Schema::hasTable('orders')) {
        //     $delegates = Delegate::get();
        //     $mechanics = Mechanic::all();

        //     // here i will share delegates key in all views which value is $delegates
        //     View::share('delegates', $delegates);

        //     /* here i will share mechanics key in a specific views that passed in an array using wildcard which meaning that I will pass this key in all views in the `project.car` folder using asterisk(*) */
        //     View::composer(['project.mechanic.index_mechanic', 'project.car.*'], function ($view) use ($mechanics) {
        //         $view->with('mechanics', $mechanics);
        //     });

        //     View::composer(['project.*', 'layouts.app'], function ($view) {
        //         if (auth()->user() and auth()->user()->getMedia('avatar')->count() > 0) {
        //             $avatar = auth()->user()->getMedia('avatar');
        //             $view->with('avatar', $avatar);
        //         } else {
        //             $view->with('avatar', '');
        //         }
        //     });

        //     View::composer(['project.order.index_order'], OrderComposer::class);
        // }
    }
}
