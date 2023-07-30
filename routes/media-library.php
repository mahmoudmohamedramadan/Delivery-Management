<?php

Route::group(['prefix' => 'media-library'], function () {

  Route::get('/', function () {
    return view('media-library');
  });

  Route::post('get-first-media', function () {
    /* notice that you will get nothing if you doesn't give name of collection to getFirstMedia method becuase if you no do this it will return first one with default collection
    ***notice that getFirstMedia download first media not get it
    ===========================================================================================================*/

    auth()->user()->getFirstMedia('avatar');
    auth()->user()->getFirstMediaUrl('avatar');

  });

  Route::post('get-name', function () {
    /* you can set/get name of specific(using index) media
      =====================================================*/
    $media = auth()->user()->getMedia('avatar');
    $media[0]->name = 'name changed';
    $media[0]->save();

    /* also you can change name of file before uploaded via usingName method and add it to defualt collection
    ========================================================================================================*/
  auth()->user()->addMedia(request()->avatar)
  ->usingName('profile')
  ->toMediaCollection();
  return auth()->user()->getMedia();

  });

  Route::post('get-file-name', function () {
    /* you can set/get name of specific(using index) media
      =====================================================*/
    $media = auth()->user()->getMedia('avatar');
    $media[0]->file_name = 'change file name';
    $media[0]->save();
    return $media[0]->file_name;

    /* also you can change file name of file before uploaded via usingFileName method and add it to defualt collection
    ========================================================================================================*/
  auth()->user()->addMedia(request()->avatar)
  ->usingFileName('test file_name.png')
  ->toMediaCollection();
  return auth()->user()->getMedia();

  });

  Route::post('sanitize-file-name', function () {

    /* also you can sanitize file uploaded forExample if you want make it's file_name upper case
    ==========================================================================================*/
  auth()->user()->addMedia(request()->avatar)
  ->sanitizingFileName(function($avatar){
    return strtoupper($avatar);
  })
  ->toMediaCollection();
  return auth()->user()->getMedia();

  });

  Route::post('prop-file-name', function () {

    /* also you can get file size but if you use size property you will get understandable number so
    ==========================================================================================*/
    $media = auth()->user()->getMedia();
    $media[0]->size;

    /* via this prop you can get understandable number
    ===================================================*/
    $media[0]->human_readable_size;

    /* via this prop you can get mime type of file
    ===================================================*/
    $media[0]->mime_type;

    /* via this prop you can delete first media
    ===================================================*/
    //$media[0]->delete();

    /* via this prop you can delete all media of this model with all collections name
    ===================================================*/
    //auth()->user()->delete();

    auth()->user()->deletePreservingMedia();
    
  });
});
