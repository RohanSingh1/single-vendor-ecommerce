<?php

namespace App\Model;

use App\Model\Admin\Admin;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id','delivery_boy_id','shipping_price','payment_option','full_names','coupon_discounts',
     'coupon_discounts_total','total_discounts','sub_totals', 'grand_totals', 'status'];

    public function products(){
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function delivery_boy(){
        return $this->belongsTo( Admin::class,'delivery_boy_id' );
    }
}
