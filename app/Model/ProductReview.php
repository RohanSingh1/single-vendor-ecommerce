<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    protected $fillable = ['product_id','user_id','star','comments','status'];

    public function product()
    {
    	return $this->belongsTo(Product::class, 'product_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
