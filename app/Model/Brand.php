<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use SoftDeletes;
    protected $table ='brands';
    public $primaryKey = 'id';
    public  $timestamps=true;
    protected $fillable = [
        'brand_name','status'
    ];
}
