<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DeliveryName extends Model
{
    protected $table = 'delivery_name';
    protected $fillable = ['delivery_name','status'];
}
