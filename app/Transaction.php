<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
class Transaction extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'transactions';
    public $timestamps = true;

    public function get_all_transactions($post) {
        $builder = DB::table("transactions");
        $builder->select("transactions.*","users.name as creator_name")
            ->join("users", "transactions.creator_id", "=", "users.id");
        $search_params = $post['searchParams'];
        $this->table_condition($builder, $search_params);
        $builder->skip($post["iDisplayStart"])->take($post["iDisplayLength"])
            ->orderBy($post["orderBy"], $post["orderSort"]);
        $data = $builder->get();
        return $data;
    }

    public function count_all($post) {
        $builder = DB::table("transactions");
        $builder->select("transactions.id")
            ->join("users", "transactions.creator_id", "=", "users.id");
        $search_params = $post['searchParams'];
        $this->table_condition($builder, $search_params);
        $count = $builder->count();
        return $count;
    }
    public function table_condition($builder, $search_params) {
        if (!empty($search_params)) {
            if (array_key_exists('code', $search_params)) {
                $builder->where('transactions.code', 'like', '%' . $search_params['code'] . '%');
            }
            if (array_key_exists('amount', $search_params)) {
                $builder->where('transactions.amount', 'like', '%' . $search_params['amount'] . '%');
            }

            if (array_key_exists('transaction_type', $search_params)) {
                $builder->where('transactions.transaction_type', '=', $search_params['transaction_type']);
            }

            if (array_key_exists('account_type', $search_params)) {
                $builder->where('transactions.account_type', '=', $search_params['account_type']);
            }


            if (array_key_exists('total_user', $search_params)) {
                $builder->where('transactions.total_user', '=', $search_params['total_user']);
            }


            if (array_key_exists('note', $search_params)) {
                $builder->where('transactions.note', 'like', '%' . $search_params['note'] . '%');
            }


            if (array_key_exists('creator_name', $search_params)) {
                $builder->where('users.name', 'like', '%' . $search_params['creator_name'] . '%');
            }

            if (array_key_exists('transaction_date', $search_params)) {
                $builder->where('users.transaction_date', 'like', '%' . $search_params['transaction_date'] . '%');
            }

        }
        return $builder;
    }
}
