<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'type','char','number','mechanic_id'
    ];
    public function delegates()
    {
        return $this->belongsToMany(\App\Models\Delegate::class);
    }
    public function mechanic()
    {
        return $this->belongsTo(\App\Models\Mechanic::class,'car_id','id','cars');
    }
}
