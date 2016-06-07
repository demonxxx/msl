<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Shop extends Model
{
	 use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'shops';

    public function user(){
    	return $this->belongsTo('App\Models\User');
    }

    public function get_all_shops($post){
        $data = DB::table("shops")
                    ->select(array("users.id","users.name", "users.email","users.identity_card","users.phone_number",
                        DB::raw('COUNT(orders.id) as count_order'), DB::raw('COUNT(agencys.id) as count_agency'),
                        "shops.code as shop_code","shops.shop_name",
                        "shops.office_number",DB::raw('city.name as office_city'), DB::raw('district.name as office_district'),
                        DB::raw('ward.name as office_ward')))
                    ->join("users","shops.user_id","=","users.id")
                    ->leftjoin("orders","orders.user_id","=","users.id")
                    ->leftjoin("administrative_units as city","city.id","=","shops.office_city_id")
                    ->leftjoin("administrative_units as district","district.id","=","shops.office_district_id")
                    ->leftjoin("administrative_units as ward","ward.id","=","shops.office_ward_id")
                    ->leftjoin("agencys","agencys.user_id","=","users.id")
                    ->groupBy("shops.id")
                    ->skip($post["start"])->take($post["length"])
                    ->get();
        return $data;
    }

    public function count_all($post){
        $count = DB::table('shops')->count();
        return $count;
    }


}
