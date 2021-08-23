<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table ='states';
    protected $fillable=['name'];

    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }
    public function city(){
        return $this->hasMany(City::class,'state_id');
    }
}
