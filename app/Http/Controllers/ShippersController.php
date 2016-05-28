<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Shipper;
use App\Shop;
use App\Shop_shipper;
use App\Helpers\helpers;
use Auth;

class ShippersController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('app.shippers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $max_id = User::max('id');
        $shipper_code = $max_id + 1;
        return view('app.shippers.create', ['shipper_code' => $shipper_code]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = \Validator::make($request->all(), [
                    'code' => 'required|max:15|unique:users',
                    'name' => 'required|max:255',
                    'username' => 'required|max:255|unique:users',
                    'password' => 'required|min:6|confirmed',
                    'phone_number' => 'required|min:10|max:11',
                    'email' => 'email|max:255|unique:users',
                    'home_number' => 'required|max:255',
                    'home_ward' => 'required|max:255',
                    'home_district' => 'required|max:255',
                    'home_city' => 'required|max:255',
                    'identity_card' => 'required|min:9|max:12',
                    'vehicle_type_id' => 'required',
                    'licence_plate' => 'required|max:10',
        ]);
        if ($validator->fails()) {
            flash_message("Tạo tài xế mới không thành công!", "danger");
            return redirect('shipper/create')->withErrors($validator)->withInput();
        } else {
            $user = new User;
            $check_code = $user->where('code', $request->code)->first();
            if (!empty($check_code)) {
                return redirect('shipper/create')->withErrors(['Mã tài xế đã tồn tại!'])->withInput();
            }
            $check_username = $user->where('username', $request->username)->first();
            if (!empty($check_username)) {
                return redirect('shipper/create')->withErrors(['Tài khoản đăng nhập đã tồn tại!'])->withInput();
            }
            $check_email = User::where('email', $request->email)->first();
            if (!empty($check_email)) {
                return redirect('shipper/create')->withErrors(['Tài khoản email đã tồn tại!'])->withInput();
            }
            $check_phone = User::where('phone_number', $request->phone_number)->first();
            if (!empty($check_phone)) {
                return redirect('shipper/create')->withErrors(['Số điện thoại đã tồn tại!'])->withInput();
            }
            $user->code = $request->code;
            $user->username = $request->username;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->identity_card = $request->identity_card;
            $user->api_token = str_random(60);
            $user->save();
            $shipper = new Shipper;
            $shipper->home_number = $request->home_number;
            $shipper->home_ward = $request->home_ward;
            $shipper->home_district = $request->home_district;
            $shipper->home_city = $request->home_city;
            $shipper->vehicle_type_id = $request->vehicle_type_id;
            $shipper->licence_plate = $request->licence_plate;
            $user->shipper()->save($shipper);
            flash_message("Tạo tài xế mới thành công!");
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id) {
        $user = new User;
        $user_obj = $user->find($user_id);
        $shipper_obj = $user_obj->shipper;
        return view("app/shippers/edit", [ "shipper" => $shipper_obj, "user" => $user_obj, "user_id" => $user_id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //dd($request->all());
        $validator = \Validator::make($request->all(), [
                    'code' => 'required|max:15',
                    'name' => 'required|max:255',
                    'phone_number' => 'required|min:10|max:11',
                    'email' => 'email|max:255',
                    'home_ward' => 'required|max:255',
                    'home_district' => 'required|max:255',
                    'home_city' => 'required|max:255',
                    'identity_card' => 'required|min:9|max:12',
                    'vehicle_type_id' => 'required',
                    'licence_plate' => 'required|max:10',
        ]);
        if ($validator->fails()) {
            flash_message("Sửa tài xế không thành công!", "danger");
            return back();
        } else {
            $user = new User;
            $user_obj = $user->find($id);
            $user_obj->code = $request->code;
            $user_obj->username = $request->username;
            $user_obj->name = $request->name;
            $user_obj->email = $request->email;
            $user_obj->phone_number = $request->phone_number;
            $user_obj->identity_card = $request->identity_card;
            $user_obj->save();
            $shipper_obj = $user_obj->shipper;
            $shipper_obj->home_number = $request->home_number;
            $shipper_obj->home_ward = $request->home_ward;
            $shipper_obj->home_district = $request->home_district;
            $shipper_obj->home_city = $request->home_city;
            $shipper_obj->office_number = $request->office_number;
            $shipper_obj->office_ward = $request->office_ward;
            $shipper_obj->office_district = $request->office_district;
            $shipper_obj->office_city = $request->office_city;
            $shipper_obj->vehicle_type_id = $request->vehicle_type_id;
            $shipper_obj->licence_plate = $request->licence_plate;
            $shipper_obj->shipper_type_id = $request->shipper_type_id;
            $shipper_obj->average_score = $request->average_score;
            $shipper_obj->profile_status = $request->profile_status;
            $shipper_obj->save();
            flash_message("Sửa tài xế thành công!");
            return redirect()->route('shippers');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function load_list(Request $request) {
        $posts = get_post_datatable_new($request->all());
        $shipper = new Shipper();
        $data = $shipper->get_all_shippers($posts);
        $length = $shipper->count_all($posts);
        $result = build_json_datatable_new($data, $length, $posts);
        return $result;
    }

    public function check_new_user_duplicate(Request $request) {
        $params = $request->all();
        $colum = $params['colum_name'];
        $value = $params['value'];
        $user = User::where($colum, $value)->first();
        if (empty($user)) {
            return "ok";
        } else {
            return "fail";
        }
    }

    public function check_update_user_duplicate(Request $request) {
        $params = $request->all();
        $colum = $params['colum_name'];
        $value = $params['value'];
        $user_id = $params['user_id'];
        $user = User::where($colum, $value)->where('id', '<>', $user_id)->first();
        if (empty($user)) {
            return "ok";
        } else {
            return "fail";
        }
    }

    public function notable_list() {
        return view('app.shippers.notable_list');
    }

    public function load_notable_list(Request $request) {
        $posts = get_post_datatable_new($request->all());
        $shop_shipper = new Shop_shipper();
        $data = $shop_shipper->load_notable_list(Auth::user()->id, $posts);
        $length = $shop_shipper->count_all_notable_list($posts);
        $result = build_json_datatable_new($data, $length, $posts);
        return $result;
    }

    public function notable_shipper(Request $request) {
        $shop_shipper = new Shop_shipper();
        $shop_shipper->notable_shipper($request->shipper_id, $request->shop_id, $request->notable);
        echo json_encode(['message' => 'success']);
    }
    
    public function register_shipper(Request $request) {
        $shipper = Shipper::where('user_id', '=', $request->user_id)->first();
        if (!empty($shipper)) {
            flash_message("Tài khoản đã là tài xế!", "danger");
            
        } else {
            $shop = Shop::where('user_id', '=', $request->user_id)->first();
            $shipper = new Shipper;
            $shipper->user_id = $shop->user_id;
            $shipper->home_number = $shop->home_number;
            $shipper->home_ward = $shop->home_ward;
            $shipper->home_district = $shop->home_district;
            $shipper->home_city = $shop->home_city;
            $shipper->office_number = $shop->office_number;
            $shipper->office_ward = $shop->office_ward;
            $shipper->office_district = $shop->office_district;
            $shipper->office_city = $shop->office_city;
            $shipper->save();
            flash_message("Đăng kí tài xế thành công!");
        }
    }

}
