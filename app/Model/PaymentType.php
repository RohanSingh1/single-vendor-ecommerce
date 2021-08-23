<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    protected $table = 'payment_types';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];

}
