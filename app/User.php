<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    public $timestamps = true;

    protected $fillable = [
        'name', 'email', 'password', 'api_token',
    ];

    protected $hidden = [
        'password', 'remember_token', 'api_token',
    ];

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_user');
    }

    public function permissions()
    {
        return $this->hasMany('App\Permission');
    }

    public function getUserRoles()
    {
        $have_roles = array();
        $roleUsers = $this->roles()->getResults();
        foreach ($roleUsers as $role) {
            array_push($have_roles, $role->name);
        }
        return $have_roles;
    }

    public function shop()
    {
        return $this->hasOne('App\Shop');
    }

    public function shipper()
    {
        return $this->hasOne('App\Shipper');
    }

    public function hasRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $need_role) {
                if ($this->checkIfUserHasRole($need_role)) {
                    return true;
                }
            }
        } else {
            return $this->checkIfUserHasRole($roles);
        }
        return false;
    }

    private function getUserRole()
    {
        return $this->roles()->getResults();
    }

    private function checkIfUserHasRole($need_role)
    {
        return in_array($need_role, $this->getUserRoles());
    }
}
