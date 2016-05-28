<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{
    protected $table = 'users';

    public $timestamps = true;

    protected $fillable = [
        'name', 'email', 'password', 'api_token','user_type','code','username','phone_number'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_user');
    }

    public function orderShippers(){
        return $this->hasMany('App\Order_shipper');
    }

    public function take_orders(){
        return $this->belongsToMany('App\Role', 'order_shipper');
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
    
    public function get_all_accounts($post) {
        $builder = DB::table("users");
        $builder->select("users.id", "users.code", "users.name", "accounts.main", "accounts.second")
                ->leftJoin("accounts", "accounts.user_id", "=", "users.id");
        $search_params = $post['searchParams'];
        $this->table_condition($builder, $search_params);
        $builder->skip($post["iDisplayStart"])->take($post["iDisplayLength"])
                ->orderBy($post["orderBy"], $post["orderSort"]);
        $data = $builder->get();
        return $data;
    }
    
    public function count_all($post) {
        $builder = DB::table("users");
        $builder->select("users.id")
                ->leftJoin("accounts", "accounts.user_id", "=", "users.id");
        $search_params = $post['searchParams'];
        $this->table_condition($builder, $search_params);
        $count = $builder->count();
        return $count;
    }
    public function table_condition($builder, $search_params) {
        if (!empty($search_params)) {
            if (array_key_exists('code', $search_params)) {
                $builder->where('users.code', 'like', '%' . $search_params['code'] . '%');
            }
            if (array_key_exists('name', $search_params)) {
                $builder->where('users.name', 'like', '%' . $search_params['name'] . '%');
            }
        }
        return $builder;
    }
}
