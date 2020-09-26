<?php

use App\Http\Controllers\Delegate\DelegateAjaxController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth', 'prefix' => '/index/ajax/settings'], function () {
  Route::get('edit-profile', [UserController::class, 'editProfileForm']);
  Route::post('edit-profile/{user}', [UserController::class, 'update']);
});

Route::group(['prefix' => '/index/ajax', 'middleware' => 'auth', 'namespace' => 'Delegate'], function () {
  Route::post('delegate', 'DelegateAjaxController@store');
  Route::patch('delegate/{id}', 'DelegateAjaxController@update');
  Route::delete('delegate/{id}', 'DelegateAjaxController@destroy');
  Route::post('delegate/delegates-order-relation', 'DelagateDBRelation@DelegateOrderRelation');
});

Route::group(['prefix'    => '/index/ajax', 'middleware' => 'auth','namespace' => 'Order'], function () {
  Route::post('delegate-order', 'OrderAjaxController@store');
  Route::get('delegate-order/{delegate}', 'OrderAjaxController@show');
  Route::patch('delegate-order/{id}', 'OrderAjaxController@update');
  Route::delete('delegate-order/{id}', 'OrderAjaxController@destroy');
  Route::post('delegate-report', [DelegateAjaxController::class, 'report']);
});

Route::group(['prefix'    => '/index/ajax', 'middleware' => 'auth','namespace' => 'Expense'], function () {
  Route::post('expense', 'ExpenseAjaxController@store');
  Route::patch('expense/{id}', 'ExpenseAjaxController@update');
  Route::delete('expense/{id}', 'ExpenseAjaxController@destroy');
});

Route::group(['prefix'    => '/index/ajax', 'middleware' => 'auth','namespace' => 'Mechanic'], function () {
  Route::post('mechanic', 'MechanicAjaxController@store');
  Route::patch('mechanic/{id}', 'MechanicAjaxController@update');
  Route::delete('mechanic/{id}', 'MechanicAjaxController@destroy');
});

Route::group(['prefix'    => '/index/ajax', 'middleware' => 'auth','namespace' => 'Car'], function () {
  Route::post('car', 'CarAjaxController@store');
  Route::patch('car/{id}', 'CarAjaxController@update');
  Route::delete('car/{id}', 'CarAjaxController@destroy');
});

Route::group(['prefix'    => '/index/ajax', 'middleware' => 'auth','namespace' => 'Company'], function () {
  Route::get('company', 'CompanyAjaxController@index');
  Route::get('company/search', 'CompanyAjaxController@search');
  Route::get('company/create', 'CompanyAjaxController@create');
  Route::post('company', 'CompanyAjaxController@store');
  Route::get('company/{id}/edit', 'CompanyAjaxController@edit');
  Route::patch('company/{id}', 'CompanyAjaxController@update');
  Route::delete('company/{id}', 'CompanyAjaxController@destroy');
});

Route::group(['prefix'     => LaravelLocalization::setLocale() . '/index','middleware' => ['localeSessionRedirect']], function () {
  Route::get('/contact-us', 'Contact.ContactController@create');
  Route::post('/contact-us/submit', 'Contact.ContactController@contact');
});

Route::get('login/{service}', 'Socailite.LoginController@redirectToProvider');
Route::get('login/{service}/callback','Socailite.LoginController@handleProviderCallback');
