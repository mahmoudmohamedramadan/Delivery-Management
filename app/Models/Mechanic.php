<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mechanic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'address'
    ];
    
    public function delegate()
    {
        return $this->hasOneThrough(\App\Models\Delegate::class, \App\Models\Car::class);
    }
}
