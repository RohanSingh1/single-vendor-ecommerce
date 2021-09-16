<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['coupon_name','slug','coupon_code','type','image','expiry_date','value','status'];

    public function products(){
        return $this->belongsToMany(Product::class, 'coupon_product', 'coupon_id', 'product_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
