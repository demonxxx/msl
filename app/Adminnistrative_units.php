<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Adminnistrative_units extends Model {

    protected $table = 'administrative_units';

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function get_all() {
        $builder = DB::table($this->table);

        $builder->select("admin_unit_1.id as city_id", "admin_unit_1.name as city_name", "admin_unit_2.id as district_id", "admin_unit_2.name as district_name", "admin_unit_3.id as ward_id", "admin_unit_3.name as ward_name")
                ->from("administrative_units as admin_unit_1")
                ->leftJoin("administrative_units as admin_unit_2", function($join) {
                    $join->on("admin_unit_1.id", "=", "admin_unit_2.parent_id");
                })
                ->leftJoin("administrative_units as admin_unit_3", function($join) {
                    $join->on("admin_unit_2.id", "=", "admin_unit_3.parent_id");
                })
                ->where("admin_unit_1.level", "=", CITY_UNIT)
                ->whereNull('admin_unit_1.deleted_at')
                ->whereNull('admin_unit_2.deleted_at')
                ->whereNull('admin_unit_3.deleted_at');
        $data = $builder->get();
        return $data;
    }

    public function get_city() {
        return DB::table($this->table)->where("level", "=", CITY_UNIT)->whereNull('deleted_at')->get();
    }

    public function get_district($city_id) {
        return DB::table($this->table)->where("parent_id", "=", $city_id)->whereNull('deleted_at')->get();
    }

    public function get_ward($district_id) {
        return DB::table($this->table)->where("parent_id", "=", $district_id)->whereNull('deleted_at')->get();
    }

}
