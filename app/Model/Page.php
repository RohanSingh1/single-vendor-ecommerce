<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Page extends Model
{
    use SoftDeletes, LogsActivity;

    protected $table = 'pages';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = [];
    public $casts = ['published' => 'boolean'];
    protected static $logName = 'Page';
    protected static $logAttributes = [
        'post_title', 'slug', 'url', 'summary', 'top_content', 'bottom_content', 'featured_image', 'published'
    ];
    protected static $logOnlyDirty = true;

    public function menus()
    {
        return $this->hasMany(Menu::class,'post_id');
    }
    public function getPrevImagePath()
    {
        return 'uploads/pages/'.$this->featured_image;
    }
    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function scopeNotPublished($query)
    {
        return $query->where('published', false);
    }

    public function scopeLocalPage($query)
    {
        return $query->where('post_type_id', 1);
    }

    public function scopeCustomLink($query)
    {
        return $query->where('post_type_id', 2);
    }

    public function scopeModuleItem($query)
    {
        return $query->where('post_type_id', 3);
    }

    public function scopeFromToday($query)
    {
        return $query->where('created_at', '<=', Carbon::now());
    }

    public function meta()
    {
        return $this->morphOne(Meta::class, 'metaable');
    }

    public function getImagePathAttribute()
    {
        return 'storage/uploads/pages/' . $this->featured_image;
    }
}
