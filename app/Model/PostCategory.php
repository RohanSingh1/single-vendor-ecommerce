<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $table = 'post_category';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = [];

    public function posts()
    {
        return $this->hasMany(Page::class, 'post_category_id');
    }


}
