<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $fillable = ['name','slug','expiry_date','image','details','status'];

    public function products(){
        return $this->belongsToMany(Product::class, 'deal_product', 'deal_id', 'product_id');
    }

}
