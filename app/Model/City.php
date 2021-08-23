<?php

namespace App\Model;

use App\model\backend\Vendor;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table ='cities';
    protected $fillable=['name'];

    public function state(){
        return $this->belongsTo(State::class,'state_id');
    }

    public function vendor()
    {
        return $this->hasMany(Vendor::class,'city_id');
    }
}
