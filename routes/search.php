<?php

Route::group(['prefix' => '/index/search/', 'middleware' => 'auth'],
  static function () {
    Route::get('delegate', 'Delegate\DelegateAjaxController@search');
    Route::get('delegate-order', 'Order\OrderAjaxController@search');
  });
