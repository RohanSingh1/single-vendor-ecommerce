<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';
    protected $fillable = [
		'user_id','type','full_name','address1','address2','email','phone','from_valley','province_id','district_id','locations'
	];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class,'district_id');
    }

    public function locations()
    {
        return $this->belongsTo(Location::class,'locations');
    }

    public function province()
    {
        return $this->belongsTo(Province::class,'province_id');
    }
}
