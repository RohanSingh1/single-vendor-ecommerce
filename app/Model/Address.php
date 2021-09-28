<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';
    protected $fillable = [
		'user_id','type','full_name','address1','address2','email','phone','from_valley'
	];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    } 
}
