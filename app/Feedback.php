<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'accounts';
    public $timestamps = true;

    public function get_transaction_users($user_ids){
        $users = [];
        foreach ($user_ids as $user_id){
            $user = DB::table("users")
                    ->join("accounts", "accounts.user_id", "=", "users.id")
                    ->where("users.deleted_at")
                    ->where("accounts.deleted_at")
                    ->where("users.id", $user_id)
                    ->select("users.id", "users.code", "users.name", "accounts.main", "accounts.second")
                    ->first();
            array_push($users, $user);
        }
        return $users;
    }

    
}