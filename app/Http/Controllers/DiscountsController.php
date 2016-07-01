<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Shipper;
use App\Shop;
use App\Discount;
use App\Discount_user;
use App\Helpers\helpers;
use Auth;

class DiscountsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('app.discounts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('app.discounts.create');
    }
    
    public function create_giftcode() {
        return view('app.discounts.create_giftcode');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
        $validator = \Validator::make($request->all(), [
                    'name' => 'required|max:255|unique:discounts',
                    'code_number' => 'required|max:255|unique:discounts',
                    'type' => 'required',
                    'amount' => 'required',
                    'total' => 'required',
                    'total_one_user' => 'required',
                    'start_time' => 'required',
                    'end_time' => 'required',
                    'list_users' => 'required'
        ]);
        if ($validator->fails()) {
            flash_message("Tạo khuyến mại mới không thành công!", "danger");
            return redirect('discount/create')->withErrors($validator)->withInput();
        } 
        $user_ids = json_decode($request->list_users);
        if (empty($user_ids)) {
            flash_message("Tạo giao dịch không thành công!", "danger");
            return redirect('discount/create')->withErrors("Không có người dùng nào!")->withInput();
        }
        $admin = Auth::user();
        if($admin->isAdmin()){
            $discount = new Discount;
            $max_id = Discount::max('id') + 1;
            $discount->code = "DC" . $max_id;
            $discount->name = $request->name;
            $discount->code_number = $request->code_number;
            $discount->type = $request->type;
            $discount->status = 1;
            $discount->amount = $request->amount;
            $discount->total = $request->total;
            $discount->total_one_user = $request->total_one_user;
            $discount->start_time = $request->start_time;
            $discount->end_time = $request->end_time;
            $discount->save();
            $list_users_tmp = json_decode($request->get('list_users', []));
            $list_users = array_unique($list_users_tmp);
            foreach ($list_users as $user_id){
                $discount_user = new Discount_user;
                $discount_user->discount_id = $discount->id;
                $discount_user->user_id = $user_id;
                $discount_user->count = 0;
                $discount_user->save();
            }
            flash_message("Tạo khuyến mại mới thành công!");
            return back();
        } else {
            flash_message("Bạn không được phép thực hiện dịch vụ này!", "danger");
            return redirect('discount/create');
        }
    }
    
    public function store_giftcode(Request $request) {
        
        $validator = \Validator::make($request->all(), [
                    'name' => 'required|max:255|unique:discounts',
                    'code_number' => 'required|max:255|unique:discounts',
                    'amount' => 'required',
                    'total' => 'required',
                    'start_time' => 'required',
                    'end_time' => 'required',
                    'list_users' => 'required'
        ]);
        if ($validator->fails()) {
            flash_message("Tạo mã quà tặng mới không thành công!", "danger");
            return redirect('discount/create_giftcode')->withErrors($validator)->withInput();
        }
        $user_ids = json_decode($request->list_users);
        if (empty($user_ids)) {
            flash_message("Tạo giao dịch không thành công!", "danger");
            return redirect('discount/create_giftcode')->withErrors("Không có người dùng nào!")->withInput();
        }
        $admin = Auth::user();
        if($admin->isAdmin()){
            $discount = new Discount;
            $max_id = Discount::max('id') + 1;
            $discount->code = "GC" . $max_id;
            $discount->name = $request->name;
            $discount->code_number = $request->code_number;
            $discount->type = 2; // for giftcode
            $discount->status = 1;
            $discount->amount = $request->amount;
            $discount->total = $request->total;
            $discount->total_one_user = 1; // default 1 time using for 1 person
            $discount->start_time = $request->start_time;
            $discount->end_time = $request->end_time;
            $discount->save();
            $list_users_tmp = json_decode($request->get('list_users', []));
            $list_users = array_unique($list_users_tmp);
            foreach ($list_users as $user_id){
                $discount_user = new Discount_user;
                $discount_user->discount_id = $discount->id;
                $discount_user->user_id = $user_id;
                $discount_user->count = 0;
                $discount_user->save();
            }
            flash_message("Tạo mã quà tặng mới thành công!");
            return back();
        } else {
            flash_message("Bạn không được phép thực hiện dịch vụ này!", "danger");
            return redirect('discount/create');
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $discount_model = new Discount();
        $discount_user_model = new Discount_user();
        $discount = $discount_model->find($id);
        $discount_users = $discount_user_model->list_discount_users($id);
        return view('app.discounts.show',["discount" => $discount, "discount_users" => $discount_users]);
    }

    

    /**
     * Lock the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function lock($id) {
        $discount_model = new Discount();
        $discount = $discount_model->find($id);
        if ($discount->status == 1) {
            $discount->status = 0;
            $discount->save();
            flash_message("Khóa mã khuyến mại thành công", "success");
            return view('app.discounts.index');
        } else {
            flash_message("Mã khuyến mãi đã bị khóa!", "danger");
            return view('app.discounts.index');
        }
    }

    public function load_list(Request $request) {
        $posts = get_post_datatable_new($request->all());
        $discount = new Discount();
        $data = $discount->get_all_discounts($posts);
        $length = $discount->count_all($posts);
        $result = build_json_datatable_new($data, $length, $posts);
        return $result;
    }
    
    public function load_list_user(Request $request)
    {
        $posts = get_post_datatable_new($request->all());
        $users = new User();
        $data = $users->get_all_users($posts);
        $length = $users->count_all_users($posts);
        $result = build_json_datatable_new($data, $length, $posts);
        return $result;
    }
    
    public function check_new_duplicate(Request $request) {
        $params = $request->all();
        $colum = $params['colum_name'];
        $value = $params['value'];
        $discount = Discount::where($colum, $value)->first();
        if (empty($discount)) {
            return "ok";
        } else {
            return "fail";
        }
    }
    

}
