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
                    ->select("users.id","users.code","users.name", "users.email","users.identity_card",
                        "shops.home_number","shops.home_ward", "shops.home_district","shops.home_city",
                        "shops.office_number","shops.office_ward", "shops.office_district","shops.office_city")
                    ->join("users","shops.user_id","=","users.id")
                    ->skip($post["start"])->take($post["length"])
                    ->get();
        return $data;
    }

    public function count_all($post){
        $count = DB::table('shops')->count();
        return $count;
    }


}
