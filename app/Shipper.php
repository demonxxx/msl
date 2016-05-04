<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Shipper extends Model
{
	 use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'shippers';

    public function user(){
    	return $this->belongsTo('App\Models\User');
    }
    
    public function get_all_shippers($post){
        $data = DB::table("shippers")
                    ->select("users.id","users.code","users.name", "users.email","shippers.identity_card",
                        "shippers.home_ward", "shippers.home_district","shippers.home_city","users.phone_number")
                    ->join("users","shippers.user_id","=","users.id")
                    ->skip($post["start"])->take($post["length"])
                    ->get();
        return $data;
    }

    public function count_all($post){
        $count = DB::table('shippers')->count();
        return $count;
    }
}
