<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Distance_freights extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'distance_freights';
    public $timestamps = true;

    public function get_all()
    {
        return DB::table($this->table)->select("{$this->table}.id", "{$this->table}.name", "{$this->table}.code", "{$this->table}.from", "{$this->table}.to", "{$this->table}.freight", "{$this->table}.vehicle_type_id", "vehicle_types.name as vhc_name")
            ->join("vehicle_types", "{$this->table}.vehicle_type_id", "=", "vehicle_types.id")
            ->whereNull("{$this->table}.deleted_at")
            ->get();
    }

    public function getFreightByDistance($distance, $vehicle_type_id)
    {
        return $this::where("vehicle_type_id", $vehicle_type_id)
            ->where("from", "<", $distance)
            ->where("to", ">=", $distance)
            ->orderBy("to", "asc")
            ->orderBy("from", "asc")
            ->first();
    }

}
