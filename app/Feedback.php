<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'feedbacks';
    public $timestamps = true;

    public function get_all_feedbacks($post) {
        $builder = DB::table("users");
        $builder->select(array("users.id", "users.code", "users.name", "users.email", "users.phone_number",
                    "feedbacks.content", "feedbacks.created_at"))
                ->join("feedbacks", "feedbacks.user_id", "=", "users.id");
        $search_params = $post['searchParams'];
        $this->table_condition($builder, $search_params);
        $builder->skip($post["iDisplayStart"])->take($post["iDisplayLength"])
                ->orderBy($post["orderBy"], $post["orderSort"]);
        $data = $builder->get();
        return $data;
    }

    public function table_condition($builder, $search_params) {
        if (!empty($search_params)) {
            if (array_key_exists('code', $search_params)) {
                $builder->where('users.code', 'like', '%' . $search_params['code'] . '%');
            }
            if (array_key_exists('name', $search_params)) {
                $builder->where('users.name', 'like', '%' . $search_params['name'] . '%');
            }
            if (array_key_exists('email', $search_params)) {
                $builder->where('users.email', 'like', '%' . $search_params['email'] . '%');
            }
            if (array_key_exists('phone_number', $search_params)) {
                $builder->where('users.phone_number', 'like', '%' . $search_params['phone_number'] . '%');
            }
            if (array_key_exists('content', $search_params)) {
                $builder->where('feedbacks.content', 'like', '%' . $search_params['content'] . '%');
            }
            if (array_key_exists('created_at', $search_params)) {
                $builder->where('feedbacks.created_at', 'like', '%' . $search_params['created_at'] . '%');
            }
        }
        return $builder;
    }

    public function count_all_feedbacks($post) {
        $builder = DB::table('feedbacks');
        $builder->select("feedbacks.id")
                ->join("users", "feedbacks.user_id", "=", "users.id");
        $search_params = $post['searchParams'];
        $this->table_condition($builder, $search_params);
        $count = $builder->count();
        return $count;
    }
}