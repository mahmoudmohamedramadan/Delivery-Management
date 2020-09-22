<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
  // indicate type of id
  protected $keyType = 'integer';
  // indicate table name
  protected $table = 'companies';

  protected $fillable = [
    'name', 'manager', 'address', 'email', 'phone', 'product_name', 'quantity'
  ];
}
