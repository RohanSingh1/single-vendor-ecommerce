<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoleHasPermission extends Model
{


    //
    protected $table ='role_has_permissions';
     public  $timestamps=false;

    public function permissions()
    {
        return $this->hasmany('App\Models\Permissions','permission_id');
    }
}
