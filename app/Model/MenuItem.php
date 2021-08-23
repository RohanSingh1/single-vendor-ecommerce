<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class MenuItem extends Model
{
    use SoftDeletes, LogsActivity;

    protected $table = 'menu_items';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = [];
    protected static $logName = 'MenuItem';
    protected static $logAttributes = [
        'post_id', 'parent_id', 'order', 'display_name', 'menu_icon', 'menu_description'
    ];
    protected static $logOnlyDirty = true;
    public $casts = ['url_target'];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function post()
    {
        return $this->belongsTo(Page::class, 'post_id');
    }

    public function postWithTrashed()
    {
        return $this->belongsTo(Page::class, 'post_id')->withTrashed();
    }

    public function publishedPost()
    {
        return $this->post()->where('published', true);
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function parentParent()
    {
        return $this->belongsTo(self::class, 'parent_id')->with('parent');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function childrenCategories()
    {
        return $this->hasMany(self::class, 'parent_id')->with('children');
    }

    public function ScopeParentOnly($query)
    {
        return $query->where('parent_id', 0);
    }
}
