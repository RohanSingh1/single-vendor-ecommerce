<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class SettingsUser extends Model
{
    protected $table = 'settings_users';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = [];

    public function setting()
    {
        return $this->belongsTo(Setting::class,'settings_id');
    }
    public function user()
    {
        $this->belongsTo(User::class,'user_id');
    }
}
