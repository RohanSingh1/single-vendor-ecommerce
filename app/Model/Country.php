<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table ='countries';
    protected $fillable=['sortname','name','phonecode'];
    public function state(){
        return $this->hasMany(State::class,'country_id');
    }
}
