<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Discount extends Model {

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'discounts';

    public function get_all_discounts($post) {
        $builder = DB::table("discounts");
        $builder->select("discounts.id", "discounts.code", "discounts.code_number", "discounts.amount", "discounts.type", "discounts.status",
                    "discounts.total", "discounts.use_count","discounts.description", "discounts.start_time", "discounts.end_time");
        $search_params = $post['searchParams'];
        $this->table_condition($builder, $search_params);
        $builder->skip($post["iDisplayStart"])->take($post["iDisplayLength"])
                ->orderBy($post["orderBy"], $post["orderSort"]);
        $data = $builder->get();
        return $data;
    }

    public function count_all($post) {
        $builder = DB::table("discounts");
        $builder->select("discounts.id");
        $search_params = $post['searchParams'];
        $this->table_condition($builder, $search_params);
        $count = $builder->count();
        return $count;
    }

    public function table_condition($builder, $search_params) {
        if (!empty($search_params)) {
            if (array_key_exists('code', $search_params)) {
                $builder->where('discounts.code', 'like', '%' . $search_params['code'] . '%');
            }
            if (array_key_exists('code_number', $search_params)) {
                $builder->where('discounts.code_number', 'like', '%' . $search_params['code_number'] . '%');
            }
            if (array_key_exists('amount', $search_params)) {
                $builder->where('discounts.amount', 'like', '%' . $search_params['amount'] . '%');
            }
            if (array_key_exists('type', $search_params)) {
                $builder->where('discounts.type', 'like', '%' . $search_params['type'] . '%');
            }
            if (array_key_exists('status', $search_params)) {
                $builder->where('discounts.status', 'like', '%' . $search_params['status'] . '%');
            }
            if (array_key_exists('total', $search_params)) {
                $builder->where('discounts.total', 'like', '%' . $search_params['total'] . '%');
            }
            if (array_key_exists('start_time', $search_params)) {
                $builder->where('discounts.start_time', '=', $search_params['start_time']);
            }
            if (array_key_exists('end_time', $search_params)) {
                $builder->where('discounts.end_time', 'like', '%' . $search_params['end_time'] . '%');
            }
            if (array_key_exists('description', $search_params)) {
                $builder->where('discounts.description', 'like', '%' . $search_params['description'] . '%');
            }
        }
        return $builder;
    }

}
