<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded=[];

    public function ScopeActive($query)
    {
        $query->where('active',1);
    }
    public function getImagePathAttribute()
    {
        return 'storage/uploads/slider-item/'.$this->image;
    }
}
