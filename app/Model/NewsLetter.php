<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class NewsLetter extends Model
{
    protected $table = 'newsletters';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = [];

}
