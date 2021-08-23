<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;
    protected $table ='suppliers';
    public $primaryKey = 'id';
    public  $timestamps=true;
    protected $fillable = [
        'supplier_name','contact_no'
    ];
}
