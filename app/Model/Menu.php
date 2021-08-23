<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Menu extends Model
{
     use SoftDeletes,LogsActivity;
    protected $table = 'menus';
    protected $primaryKey = 'id';
    public  $timestamps = true;
    protected $guarded =[];
    public $casts=['is_selected','is_active'];
    protected static $logName = 'Menu';
    protected static $logAttributes = [
        'title','slug','is_active','is_selected'
    ];
    protected static $logOnlyDirty = true;

    public function scopeActive($query)
    {
        return $query->where('is_active',true);
    }

    public function scopeMainMenu($query)
    {
        return $query->where('slug','main-menu');
    }
    public function scopePreNav($query)
    {
        return $query->where('slug','pre-nav');
    }
    public function scopeFirstFooter($query)
    {
        return $query->where('slug','first-footer');
    }
    public function scopeSecondFooter($query)
    {
        return $query->where('slug','second-footer');
    }
    public function scopeThirdFooter($query)
    {
        return $query->where('slug','third-footer');
    }

    public function scopeNotActive($query)
    {
        return $query->where('is_active',false);
    }
    public function scopeSelected($query)
    {
        return $query->where('is_selected',true);
    }

    public function scopeNotSelected($query)
    {
        return $query->where('is_selected',false);
    }

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class,'menu_id');
    }
    public function activeMenuItems()
    {
        return $this->hasMany(MenuItem::class,'menu_id');
    }
}
