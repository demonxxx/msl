<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Shop_shipper extends Model {

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'shop_shipper';

    public function load_notable_list($current_user_id, $post) {
        $builder = DB::table($this->table);
        $builder->select("users.code", "users.name", "users.phone_number", DB::raw("count(orders.id) as ship_number"), "shippers.id as shipper_id", "shops.id as shop_id", "shop_shipper.type")
                ->from("orders")
                ->join("shops", "orders.user_id", "=", "shops.user_id")
                ->join("shippers", "orders.shipper_id", "=", "shippers.id")
                ->leftJoin("shop_shipper", function($join) {
                    $join->on("shops.id", "=", "shop_shipper.shop_id")
                    ->on("shippers.id", "=", "shop_shipper.shipper_id");
                })
                ->join("users", "shippers.user_id", "=", "users.id");
        $search_params = $post['searchParams'];
        $this->table_condition($builder, $search_params);
        $builder->skip($post["iDisplayStart"])->take($post["iDisplayLength"])
                ->orderBy($post["orderBy"], $post["orderSort"]);
        $builder->groupBy("shippers.id");
        $data = $builder->get();
        return $data;
    }

    public function count_all_notable_list($post) {
        $builder = DB::table($this->table);
        $builder->select("users.id")
                ->from("orders")
                ->join("shops", "orders.user_id", "=", "shops.user_id")
                ->join("shippers", "orders.shipper_id", "=", "shippers.id")
                ->leftJoin("shop_shipper", function($join) {
                    $join->on("shops.id", "=", "shop_shipper.shop_id")
                    ->on("shippers.id", "=", "shop_shipper.shipper_id");
                })
                ->join("users", "shippers.user_id", "=", "users.id");
        $search_params = $post['searchParams'];
        $this->table_condition($builder, $search_params);
        $builder->groupBy("shippers.id");
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
            if (array_key_exists('phone_number', $search_params)) {
                $builder->where('users.phone_number', 'like', '%' . $search_params['phone_number'] . '%');
            }
        }
        return $builder;
    }

    public function notable_shipper($shipper_id, $shop_id, $notable) {
        $notable_check = DB::table($this->table)
                ->where("shop_id", "=", $shop_id)
                ->where("shipper_id", "=", $shipper_id)
                ->get();
        if (empty($notable_check)) {
            $inserted_id = DB::table($this->table)
                    ->insert([
                "shipper_id" => $shipper_id,
                "shop_id" => $shop_id,
                "type" => $notable,
                "created_at" => date("Y-m-d h:m:i")
            ]);
        } else {
            DB::table($this->table)
                    ->where('id', $notable_check[0]->id)
                    ->update([
                        "type" => $notable,
                        "updated_at" => date("Y-m-d h:m:i")
            ]);
        }
    }

}
