<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order_shipper extends Model
{
     use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'order_shipper';

    public function user(){
        $this->belongsTo('App\User','users');
    }

    public function order(){
        $this->belongsTo('App\Order','orders');
    }
}
