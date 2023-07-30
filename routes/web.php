<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::view('/', 'welcome');

Route::group(['middleware' => 'web'], function () {
    Route::view('/index', 'project.index');
    Route::view('index/settings/{id}', 'project.settings.index_settings');
});

Route::group(['middleware' => 'auth', 'namespace' => 'Delegate', 'prefix' => 'index'], function () {
    Route::get('delegate', 'DelegateController@index');
    Route::get('delegate/create', 'DelegateController@create');
    Route::post('delegate', 'DelegateController@store');
    // Route::livewire('delegate/{id}/edit', 'edit-delegate')
    //     ->section('title')
    //     ->section('content');
    Route::delete('delegate/{id}', 'DelegateController@destroy');
});

Route::group(['middleware' => 'auth', 'namespace' => 'Order', 'prefix' => '/index'], function () {
    Route::get('delegate-order', 'OrderController@index');
    Route::get('delegate-order/create', 'OrderController@create');
    Route::post('delegate-order', 'OrderController@store');
    Route::get('delegate-order/{id}', 'OrderController@show');
    Route::get('delegate-order/{id}/edit', 'OrderController@edit');
    Route::patch('delegate-order/{id}', 'OrderController@update');
    Route::delete('delegate-order/{id}', 'OrderController@destroy');
});

Route::group(['middleware' => 'auth', 'namespace' => 'Expense', 'prefix' => '/index'], function () {
    Route::get('expense', 'ExpenseController@index');
    Route::get('expense/create', 'ExpenseController@create');
    Route::post('expense', 'ExpenseController@store');
    Route::get('expense/{id}/edit', 'ExpenseController@edit');
    Route::patch('expense/{id}', 'ExpenseController@update');
    Route::delete('expense/{id}', 'ExpenseController@destroy');
});

// Multi Languages...
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect']], function () {
    Route::get('/contact-us', 'Contact\ContactController@create');
    Route::post('/contact-us/submit', 'Contact\ContactController@contact');
});

Route::get('login/{service}', 'Socailite\LoginController@redirectToProvider');
Route::get('login/{service}/callback', 'Socailite.LoginController@handleProviderCallback');

// Notifications...
Route::get('/index/{user}/notifications', 'Notification\NotificationController@index');
Route::delete('/index/{user}/notifications', 'Notification\NotificationController@destroy');

// Route::get('manyTomany', function () {
//notice in manyTomany relationship when you use whereHas student which has specific teacher this same teacher should has this same student, if i say student number 1 has teacher number 3 in student's table teacher number 3 shold has student number 1 in teacher's table
// $cars_delegate_mTm = \App\Models\Cars::whereHas('delegates')->get(); // hasMany,hasMany case
// });
