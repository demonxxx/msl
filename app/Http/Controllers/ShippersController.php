<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Shipper;
use App\Shop;
use App\Shop_shipper;
use App\Adminnistrative_units;
use App\ShipperType;
use App\VehicleType;
use App\Helpers\helpers;
use Auth;

class ShippersController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $districts = Adminnistrative_units::where("level", DISTRICT_UNIT)->get();
        return view('app.shippers.index', ["districts" => $districts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $cities = Adminnistrative_units::where("level", CITY_UNIT)->get();
        $shippertype = new ShipperType;
        $shippertypes = $shippertype->all();
        $vehicletype = new VehicleType;
        $vehicletypes = $vehicletype->all();
        return view('app.shippers.create', ['shippertypes' => $shippertypes, 'vehicletypes' => $vehicletypes, 'cities' => $cities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = \Validator::make($request->all(), [
                    'name' => 'required|max:255',
                    'username' => 'required|max:255|unique:users',
                    'password' => 'required|min:6|confirmed',
                    'phone_number' => 'required|min:10|max:11|unique:users',
                    'email' => 'required|email|max:255|unique:users',
                    'home_number' => 'required|max:255',
                    'home_ward_id' => 'required',
                    'home_district_id' => 'required',
                    'home_city_id' => 'required',
                    'identity_card' => 'required|min:9|max:12',
                    'vehicle_type_id' => 'required',
                    'shipper_type_id' => 'required',
                    'licence_plate' => 'required|max:12',
                    'licence_driver_number' => 'required|max:12',
        ]);
        if ($validator->fails()) {
            flash_message("Tạo tài xế mới không thành công!", "danger");
            return redirect('shipper/create')->withErrors($validator)->withInput();
        } else {
            $user = new User;
            $max_id = User::max('id') + 1;
            $user->code = "U" . $max_id;
            $user->username = $request->username;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->identity_card = $request->identity_card;
            $user->api_token = str_random(60);
            $user->save();
            $shipper = new Shipper;
            $max_id = Shipper::max('id') + 1;
            $shipper->code = "TX" . $max_id;
            $shipper->home_number = $request->home_number;
            $shipper->home_ward_id = $request->home_ward_id;
            $shipper->home_district_id = $request->home_district_id;
            $shipper->home_city_id = $request->home_city_id;
            $shipper->vehicle_type_id = $request->vehicle_type_id;
            $shipper->shipper_type_id = $request->shipper_type_id;
            $shipper->licence_plate = $request->licence_plate;
            $shipper->licence_driver_number = $request->licence_driver_number;
            $shipper->profile_status = "Chưa xác thực";
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
        $shippertype = new ShipperType;
        $shippertypes = $shippertype->all();
        $vehicletype = new VehicleType;
        $vehicletypes = $vehicletype->all();
        $cities = Adminnistrative_units::where("level", CITY_UNIT)->get();
        $districts = Adminnistrative_units::where("level", DISTRICT_UNIT)->where("parent_id", $shipper_obj->home_city_id)->get();
        $wards = Adminnistrative_units::where("level", WARD_UNIT)->where("parent_id", $shipper_obj->home_district_id)->get();
        return view("app/shippers/edit", [ "shipper" => $shipper_obj, "user" => $user_obj, "user_id" => $user_id,
            'shippertypes' => $shippertypes, 'vehicletypes' => $vehicletypes, 'cities' => $cities, 'districts' => $districts, 'wards' => $wards]);
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
                    'name' => 'required|max:255',
                    'phone_number' => 'required|min:10|max:11',
                    'email' => 'required|email|max:255',
                    'home_number' => 'required|max:255',
                    'home_ward_id' => 'required',
                    'home_district_id' => 'required',
                    'home_city_id' => 'required',
                    'identity_card' => 'required|min:9|max:12',
                    'vehicle_type_id' => 'required',
                    'shipper_type_id' => 'required',
                    'licence_plate' => 'required|max:12',
                    'licence_driver_number' => 'required|max:12',
        ]);
        if ($validator->fails()) {
            flash_message("Sửa tài xế không thành công!", "danger");
            return back();
        } else {
            $user = new User;
            $user_obj = $user->find($id);
            $user_obj->name = $request->name;
            $user_obj->email = $request->email;
            $user_obj->phone_number = $request->phone_number;
            $user_obj->identity_card = $request->identity_card;
            $user_obj->save();
            $shipper_obj = $user_obj->shipper;
            $shipper_obj->home_number = $request->home_number;
            $shipper_obj->home_ward_id = $request->home_ward_id;
            $shipper_obj->home_district_id = $request->home_district_id;
            $shipper_obj->home_city_id = $request->home_city_id;
            $shipper_obj->vehicle_type_id = $request->vehicle_type_id;
            $shipper_obj->licence_plate = $request->licence_plate;
            $shipper_obj->licence_driver_number = $request->licence_driver_number;
            $shipper_obj->shipper_type_id = $request->shipper_type_id;
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
            $max_id = Shipper::max('id') + 1;
            $shipper->code = "TX" . $max_id;
            $shipper->user_id = $shop->user_id;
            $shipper->home_number = $shop->home_number;
            $shipper->home_ward = $shop->home_ward;
            $shipper->home_district = $shop->home_district;
            $shipper->home_city = $shop->home_city;
            $shipper->save();
            flash_message("Đăng kí tài xế thành công!");
        }
    }

    public function update_isActive($shipper_id) {
        $shipper = new Shipper();
        $shipper_obj = $shipper::find($shipper_id);
        $shipper_obj->isActive = ($shipper_obj->isActive == 2) ? 1 : 2;
        echo $shipper_obj->save();
    }

}
