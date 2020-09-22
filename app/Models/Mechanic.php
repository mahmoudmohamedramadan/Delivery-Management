<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mechanic extends Model
{
    protected $fillable = [
        'name','address'
    ];
    public function delegate()
    {
        return $this->hasOneThrough(\App\Models\Delegate::class,\App\Models\Car::class);
    }
}
