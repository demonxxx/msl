<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Order extends Model {

    protected $table = 'orders';

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $fillable = [
    ];
    protected $hidden = [
    ];

    public function user() {
        $this->belongsTo('App\User', 'users');
    }

    public function shippers() {
        $this->belongsToMany('App\User', 'order_shipper');
    }

    public function orderShippers() {
        return $this->hasMany('App\Order_shipper');
    }

    public function get_all_orders($post, $user_id) {
        $builder = DB::table("orders");
        $builder->select("orders.id", "shops.code as shop_code", "shippers.code as shipper_code", "orders.code", "street_from.name as street_from_name", "district_from.name as district_from_name", "street_to.name as street_to_name", "district_to.name as district_to_name", "orders.status")
                ->leftJoin("shops", "orders.user_id", "=", "shops.user_id")
                ->leftJoin("shippers", "orders.shipper_id", "=", "shippers.user_id")
                ->leftJoin("administrative_units as street_from", "orders.street_from", "=", "street_from.id")
                ->leftJoin("administrative_units as district_from", "orders.district_from", "=", "district_from.id")
                ->leftJoin("administrative_units as street_to", "orders.street_to", "=", "street_to.id")
                ->leftJoin("administrative_units as district_to", "orders.district_to", "=", "district_to.id")
                ->where('orders.deleted_at')
                ->where("orders.user_id", $user_id);
        $search_params = $post['searchParams'];
        $this->table_condition($builder, $search_params);
        $builder->skip($post["iDisplayStart"])->take($post["iDisplayLength"])
                ->orderBy($post["orderBy"], $post["orderSort"]);
        $data = $builder->get();
        return $data;
    }

    public function count_all($post, $user_id) {
        $builder = DB::table("orders");
        $builder->select("orders.id")
                ->leftJoin("shops", "orders.user_id", "=", "shops.user_id")
                ->leftJoin("shippers", "orders.shipper_id", "=", "shippers.user_id")
                ->leftJoin("administrative_units as street_from", "orders.street_from", "=", "street_from.id")
                ->leftJoin("administrative_units as district_from", "orders.district_from", "=", "district_from.id")
                ->leftJoin("administrative_units as street_to", "orders.street_to", "=", "street_to.id")
                ->leftJoin("administrative_units as district_to", "orders.district_to", "=", "district_to.id")
                ->where("orders.user_id", $user_id);
        $search_params = $post['searchParams'];
        $this->table_condition($builder, $search_params);
        $count = $builder->count();
        return $count;
    }

    public function table_condition($builder, $search_params) {
        if (!empty($search_params)) {
            if (array_key_exists('code', $search_params)) {
                $builder->where('orders.code', 'like', '%' . $search_params['code'] . '%');
            }
            if (array_key_exists('shop_code', $search_params)) {
                $builder->where('shops.code', 'like', '%' . $search_params['shop_code'] . '%');
            }
            if (array_key_exists('shipper_code', $search_params)) {
                $builder->where('shippers.code', 'like', '%' . $search_params['shipper_code'] . '%');
            }
            if (array_key_exists('street_from_name', $search_params)) {
                $builder->where('orders.street_from', '=', $search_params['street_from_name']);
            }
            if (array_key_exists('street_to_name', $search_params)) {
                $builder->where('orders.street_to', '=', $search_params['street_to_name']);
            }
            if (array_key_exists('district_from_name', $search_params)) {
                $builder->where('orders.district_from', '=', $search_params['district_from_name']);
            }
            if (array_key_exists('district_to_name', $search_params)) {
                $builder->where('orders.district_to', '=', $search_params['district_to_name']);
            }
            if (array_key_exists('status', $search_params)) {
                $builder->where('orders.status', '=', $search_params['status']);
            }
        }
        return $builder;
    }

    public function details($order_id) {
        $builder = DB::table("orders");
        $builder->select("users.code as customer_code", "users.name as customer_name", "users.email as customer_email", "users.phone_number as customer_phone_number", "orders.*", "order_types.name as order_type_name", "vehicle_types.name as vehicle_name", "shipper.*")
                ->leftJoin("order_types", "orders.order_type_id", "=", "order_types.id")
                ->leftJoin("vehicle_types", "orders.vehicle_type_id", "=", "vehicle_types.id")
                ->leftJoin(DB::raw("(select shippers.id, shippers.code as shipper_code, users.name as shipper_name, users.phone_number as shipper_phone_number
                            from shippers join users on shippers.user_id = users.id) as shipper"), "orders.shipper_id", "=", "shipper.id")
                ->join("users", "orders.user_id", "=", "users.id")
                ->where("orders.id", "=", $order_id);
        $data = $builder->first();
        return $data;
    }

}
