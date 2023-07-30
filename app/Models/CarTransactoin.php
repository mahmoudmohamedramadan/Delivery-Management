<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarTransactoin extends Model
{
    protected $fillable = [
        'car_id', 'transaction_id'
    ];
}
