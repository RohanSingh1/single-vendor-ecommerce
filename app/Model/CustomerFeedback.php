<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CustomerFeedback extends Model
{
    protected $fillable = ['name','email','contact_no','feedback','product_id'];

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
