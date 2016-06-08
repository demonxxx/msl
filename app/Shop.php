<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Shop extends Model {

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'shops';

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function get_all_shops($post) {
        $builder = DB::table("shops");
        $builder->select(array("users.id", "users.name", "users.email", "users.identity_card", "users.phone_number",
                    DB::raw('COUNT(orders.id) as count_order'), DB::raw('COUNT(agencys.id) as count_agency'),
                    "shops.code as shop_code", "shops.shop_name",
                    "shops.office_number", 'city.name as office_city', DB::raw('district.name as office_district'),
                    DB::raw('ward.name as office_ward'), "shops.profile_status", "shops.isActive"))
                ->join("users", "shops.user_id", "=", "users.id")
                ->leftjoin("orders", "orders.user_id", "=", "users.id")
                ->leftjoin("administrative_units as city", "city.id", "=", "shops.office_city_id")
                ->leftjoin("administrative_units as district", "district.id", "=", "shops.office_district_id")
                ->leftjoin("administrative_units as ward", "ward.id", "=", "shops.office_ward_id")
                ->leftjoin("agencys", "agencys.user_id", "=", "users.id");
        $search_params = $post['searchParams'];
        $this->table_condition($builder, $search_params);
        $builder->skip($post["iDisplayStart"])->take($post["iDisplayLength"])
                ->orderBy($post["orderBy"], $post["orderSort"])
                ->groupBy("shops.id");
        $data = $builder->get();
        return $data;
    }

    public function table_condition($builder, $search_params) {
        if (!empty($search_params)) {
            if (array_key_exists('shop_code', $search_params)) {
                $builder->where('shops.shop_code', 'like', '%' . $search_params['shop_code'] . '%');
            }
            if (array_key_exists('name', $search_params)) {
                $builder->where('users.name', 'like', '%' . $search_params['name'] . '%');
            }
            if (array_key_exists('shop_name', $search_params)) {
                $builder->where('shops.shop_name', 'like', '%' . $search_params['shop_name'] . '%');
            }
            if (array_key_exists('phone_number', $search_params)) {
                $builder->where('shops.phone_number', 'like', '%' . $search_params['phone_number'] . '%');
            }
            if (array_key_exists('count_order', $search_params)) {
                $builder->having('count_order', '=', $search_params['count_order']);
            }
            if (array_key_exists('count_agency', $search_params)) {
                $builder->having('count_agency', 'like', $search_params['count_agency']);
            }
            if (array_key_exists('office_district', $search_params)) {
                $builder->where('shops.office_district_id', '=', $search_params['office_district']);
            }
            if (array_key_exists('profile_status', $search_params)) {
                $builder->where('shops.profile_status', '=', $search_params['profile_status']);
            }
        }
        return $builder;
    }

    public function count_all($post) {
        $builder = DB::table('shops');
        $builder->select("shops.id")
                ->join("users", "shops.user_id", "=", "users.id")
                ->leftjoin("orders", "orders.user_id", "=", "users.id")
                ->leftjoin("administrative_units as city", "city.id", "=", "shops.office_city_id")
                ->leftjoin("administrative_units as district", "district.id", "=", "shops.office_district_id")
                ->leftjoin("administrative_units as ward", "ward.id", "=", "shops.office_ward_id")
                ->leftjoin("agencys", "agencys.user_id", "=", "users.id");
        $search_params = $post['searchParams'];
        $this->table_condition($builder, $search_params);
        $builder->groupBy("shops.id");
        $count = $builder->count();
        return $count;
    }

    public function details($shop_id) {
        $builder = DB::table('shop_view');
        $builder->where('id', '=', $shop_id);
        $shop = $builder->first();
        $order = DB::table("orders")
                ->select('orders.id')
                ->where("orders.user_id", "=", $shop->user_id)
                ->count();
        $shop->order_number = $order;
        $agency = DB::table("agencys")
                ->select('agencys.id')
                ->where("agencys.user_id", "=", $shop->user_id)
                ->count();
        $shop->agency_number = $agency;
        return $shop;
    }

}
