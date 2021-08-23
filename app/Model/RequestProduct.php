<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class RequestProduct extends Model
{
    protected $table ='request_product';
    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
