<?php

namespace App\Model\Admin;

use App\Model\Brand;
use App\Model\Category;
use App\Model\SettingsUser;
use App\Notifications\AdminResetPasswordNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use Notifiable,HasRoles;

    protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','is_super','is_admin','status','type','image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function userSettings()
    {
        return $this->hasMany(SettingsUser::class,'settings_id')->where('user_id',auth('admin')->user()->id);
    }
    public function settings()
    {
        return $this->hasMany(SettingsUser::class,'settings_id');
    }
    public function category()
    {
        return $this->hasMany(Category::class,'created_by');
    }
    public function vendor()
    {
        return $this->hasMany(Vendor::class,'created_by');
    }
    public function brand()
    {
        return $this->hasMany(Brand::class,'created_by');
    }
    public function hasRoles($role)
    {
        return $this->role == $role;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }

    public function adminOrderDetail()
    {
        return $this->belongsToMany(OrderDetail::class,'admin_order_detail','admin_id','order_detail_id');
    }
    public function adminOrder()
    {
        return $this->belongsToMany(Order::class,'admin_order','admin_id','order_id');
    }

}
