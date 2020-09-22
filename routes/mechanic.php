<?php

use Illuminate\Support\Facades\Route;

Route::group([
  'prefix' => '/index', 'middleware' => 'auth', 'namespace' => 'Car'
], function () {
  Route::get('car', 'CarController@index');
  Route::get('car/create', 'CarController@create');
  Route::post('car', 'CarController@store');
  Route::get('car/{id}/edit', 'CarController@edit');
  Route::patch('car/{id}', 'CarController@update');
  Route::delete('car/{id}', 'CarController@destroy');
});

Route::group([
  'prefix' => '/index', 'middleware' => 'auth', 'namespace' => 'Mechanic'
], function () {
  Route::get('mechanic', 'MechanicController@index');
  Route::get('mechanic/create', 'MechanicController@create');
  Route::post('mechanic', 'MechanicController@store');
  Route::get('mechanic/{id}/edit', 'MechanicController@edit');
  Route::patch('mechanic/{id}', 'MechanicController@update');
  Route::delete('mechanic/{id}', 'MechanicController@destroy');
});

Route::group([
  'prefix' => '/index', 'middleware' => 'auth', 'namespace' => 'Payment'
], function () {
  Route::get('car-payment/{id}', 'PaymentController@index');
  Route::get(
    'car-payment/{id}/{price}/form',
    'PaymentController@getCheckOutId'
  );
});
