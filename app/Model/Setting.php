<?php

namespace App\Model;

use App\Model\SettingsUser;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['slug', 'value', 'active'];
    public $casts=[
        'active'=>'boolean'
    ];
    public function settingsUser()
    {
        return $this->hasMany(SettingsUser::class);
    }

    public function ScopeActive($query)
    {
        $query->where('active',true);
    }
    public function getFileAttribute($value)
    {
       return 'storage/uploads/configuration/settings/'.$value;
    }
}
