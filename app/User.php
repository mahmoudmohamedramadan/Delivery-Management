<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class User extends Authenticatable implements HasMedia
{
  use Notifiable, HasMediaTrait;


  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'email', 'phone', 'password', 'active'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function hasMedia(string $collectionName = 'default'): bool
  {
    return $this->getMedia($collectionName) ? true : false;
  }

  public function registerMediaCollections()
  {
    $this->addMediaCollection('avatar')
      ->singleFile()
      ->onlyKeepLatest(1);
  }
}
