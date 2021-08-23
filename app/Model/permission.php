<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class permission extends Model
{

    protected $table ='permission';
    public  $timestamps=false;
}
