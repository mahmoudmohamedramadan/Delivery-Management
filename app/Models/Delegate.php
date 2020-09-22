<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class Delegate extends Model {
  // keyword table used when modelName different than it's tableName in database
  protected $table = 'delegates';
  //fillable as you say i want when insert/update data to insert/update these columns which exists in database
  protected $fillable = [
    'name', 'national_id', 'phone', 'motor_size', 'car_id', 'made_date', 'image'
  ];
  //via this lower line timestamps does not save in database
  // protected $timestamps = false;
  public function orders() {
    return $this->hasMany(\App\Models\Order::class, 'delegate_id', 'id');
  }

  public function scopeId($query) {
    return $query->whereId(3);
  }
  // protected static function boot()
  // {
  //     parent::boot();
  //     static::addGlobalScope(new \App\Scopes\OrdersScope);
  // }
  public function cars()
  : \Illuminate\Database\Eloquent\Relations\BelongsToMany {
    return $this->belongsToMany(\App\Models\Car::class);
  }

  public function setImageAttribute()
  : void {
    if (request()->has('image')) {
      $imageName = request()->image->getClientOriginalName();
      // $imageExc = request()->image->getClientOriginalExtenstion();
      request()->image->move('images/delegate/', $imageName);
      $this->attributes['image'] = $imageName;
    }
  }
}
