<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'provinces';
    protected $fillable = ['name','status'];

    public function users(){
        $this->hasMany(User::class,'user_id');
    }

    public function districts(){
        $this->hasMany(District::class,'province_id');
    }

}
