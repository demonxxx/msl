<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Helpers\constants;
use DB;

class Configs extends Model {

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'configs';

    public function get_all_configs() {
        return DB::table($this->table)->get();
    }

    public function get_gcm_config() {
        return DB::table($this->table)->where("name", "=", GOOGLE_API_KEY)->get();
    }

}
