<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';
    protected $fillable = ['name','slug','price','province_id','district_id','status'];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class,'district_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class,'province_id');
    }
}
