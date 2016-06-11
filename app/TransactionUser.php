<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
class TransactionUser extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'transaction_user';
    public $timestamps = true;

    public function getUsersByTransaction($transaction_id){
        return DB::table("transaction_user")
            ->join("transactions", "transaction_user.transaction_id", "=", "transactions.id")
            ->join("users", "transaction_user.user_id", "=", "users.id")
            ->where("transactions.id", $transaction_id)
            ->select("users.id", "users.code", "users.name", "users.email", "users.phone_number")
            ->get();
    }
}
