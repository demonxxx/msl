<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Shipper extends Model {

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'shippers';

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function get_all_shippers($post) {
        $builder = DB::table("shippers");
        $builder->select(array("users.id", "users.code", "users.name", "users.email", "users.identity_card", "shippers.average_score", 
            "shippers.profile_status", "shippers.home_district", "users.phone_number",DB::raw('COUNT(shipper_order_histories.id) as count_order'),))
                ->join("users", "shippers.user_id", "=", "users.id")
                ->leftjoin("shipper_order_histories", "shipper_order_histories.shipper_id", "=", "users.id");
        $search_params = $post['searchParams'];
        $this->table_condition($builder, $search_params);
        $builder->skip($post["iDisplayStart"])->take($post["iDisplayLength"])
                ->orderBy($post["orderBy"], $post["orderSort"]);
        $data = $builder->get();
        return $data;
    }

    public function count_all($post) {
//        $count = DB::table('shippers')->count();
        $builder = DB::table("shippers");
        $builder->select("users.id")
                ->join("users", "shippers.user_id", "=", "users.id");
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
            if (array_key_exists('email', $search_params)) {
                $builder->where('users.email', 'like', '%' . $search_params['email'] . '%');
            }
            if (array_key_exists('identity_card', $search_params)) {
                $builder->where('users.identity_card', 'like', '%' . $search_params['identity_card'] . '%');
            }
            if (array_key_exists('home_number', $search_params)) {
                $builder->where('shippers.home_number', 'like', '%' . $search_params['home_number'] . '%');
            }
            if (array_key_exists('home_ward', $search_params)) {
                $builder->where('shippers.home_ward', 'like', '%' . $search_params['home_ward'] . '%');
            }
            if (array_key_exists('home_district', $search_params)) {
                $builder->where('shippers.home_district', 'like', '%' . $search_params['home_district'] . '%');
            }
            if (array_key_exists('home_city', $search_params)) {
                $builder->where('shippers.home_city', 'like', '%' . $search_params['home_city'] . '%');
            }
            if (array_key_exists('phone_number', $search_params)) {
                $builder->where('users.phone_number', 'like', '%' . $search_params['phone_number'] . '%');
            }
        }
        return $builder;
    }

}
