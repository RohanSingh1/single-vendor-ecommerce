<?php

namespace App;

use App\Model\ContactProduct;
use App\Model\Coupon;
use App\Model\SettingsUser;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{

    // use Notifiable;
    use Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

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
        'is_user' => 'boolean',
    ];

    public function getFullNameAttribute()
    {
        if ($this->f_name and $this->l_name) {
            return $this->f_name . ' ' . $this->m_name . ' ' . $this->l_name;
        } else {
            return $this->name;
        }
    }

    public function hasRoles($role)
    {
        return $this->role == $role;
    }

    public function contactProduct()
    {
        return $this->hasMany(ContactProduct::class, 'user_id');
    }

    public function settingsUser()
    {
        return $this->hasMany(SettingsUser::class);
    }

    public function coupons(){
        return $this->hasMany(Coupon::class);
    }
}
