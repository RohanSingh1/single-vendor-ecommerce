<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colors';
    public $timestamps = false;
    protected $fillable = ['name', 'value'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'color', 'color_id', 'product_idss');
    }
}

