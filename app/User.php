<?php

namespace App;

use App\Model\ContactProduct;
use App\Model\SettingsUser;
use App\Model\WishList;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
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

    public function addresses() {
		return $this->hasMany( Address::class );
	}

    public function myorders(){
        return $this->hasMany(Order::class,'user_id');
    }

    public function mywishlists(){
        return $this->hasMany(WishList::class,'user_id');
    }
}
