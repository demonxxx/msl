<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Vehicle_types extends Model {

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'vehicle_types';
    public $timestamps = true;

}
