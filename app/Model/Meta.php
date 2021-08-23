<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Meta extends Model
{

    use LogsActivity;

    protected $table = 'meta';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = [];
    protected static $logName = 'Meta';
    protected static $logAttributes = [ 'meta_title', 'meta_keyword', 'meta_desc','metaable_id','metaable_type'];
    protected static $logOnlyDirty = true;

    public function metaable()
    {
        return $this->morphTo();
    }
}
