<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    protected $table = 'wishlists';
    protected $fillable = ['product_id','user_id'];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

}
