<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Order extends Model
{
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

    public function user(){
    	$this->belongsTo('App\User','users');
    }

    public function shippers(){
        $this->belongsToMany('App\User','order_shipper');
    }

    public function orderShippers(){
        return $this->hasMany('App\Order_shipper');
    }
    
    public function get_all_orders($post, $user_id) {
        $builder = DB::table("orders");
        $builder->select("orders.id", "orders.code", "orders.name", "orders.recipient_name", "orders.recipient_phone", "orders.ward_from", "orders.ward_to",
                "orders.district_from", "orders.district_to")
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
            if (array_key_exists('name', $search_params)) {
                $builder->where('orders.name', 'like', '%' . $search_params['name'] . '%');
            }
            if (array_key_exists('recipient_name', $search_params)) {
                $builder->where('orders.recipient_name', 'like', '%' . $search_params['recipient_name'] . '%');
            }
            if (array_key_exists('recipient_phone', $search_params)) {
                $builder->where('orders.recipient_phone', 'like', '%' . $search_params['recipient_phone'] . '%');
            }
            if (array_key_exists('ward_from', $search_params)) {
                $builder->where('orders.ward_from', 'like', '%' . $search_params['ward_from'] . '%');
            }
            if (array_key_exists('ward_to', $search_params)) {
                $builder->where('orders.ward_to', 'like', '%' . $search_params['ward_to'] . '%');
            }
            if (array_key_exists('district_from', $search_params)) {
                $builder->where('orders.district_from', 'like', '%' . $search_params['district_from'] . '%');
            }
            if (array_key_exists('district_to', $search_params)) {
                $builder->where('orders.district_to', 'like', '%' . $search_params['district_to'] . '%');
            }
        }
        return $builder;
    }
}
