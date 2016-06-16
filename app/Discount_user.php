<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Discount_user extends Model {

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'discount_user';

    public function list_discount_users($id){
        $builder = DB::table("discount_user");
        $builder->select("users.id", "users.code", "users.name")
                ->join("users", "discount_user.user_id", "=", "users.id")
                ->where("discount_id", $id);
        $data = $builder->get();
        return $data;
    }
}
