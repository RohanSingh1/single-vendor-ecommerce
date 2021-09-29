<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';
    protected $fillable = ['name','slug','province_id','status']; 

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
