<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use App\Shipper;

use App\Helpers\helpers;

class ShippersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.shippers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(),  [
            'code'              => 'required',
            'name'              => 'required',
            'username'          => 'required',
            'phone_number'      => 'required',
            'email'             => 'email',
            'home_number'       => 'required',
            'home_ward'         => 'required',
            'home_district'     => 'required',
            'home_city'         => 'required',
            'identity_card'     => 'required',
            'vehicle_type_id'   => 'required',
            'licence_plate'     => 'required',
        ]);
        if ($validator->fails()) {
            flash_message("Tạo tài xế mới không thành công!","danger");
            return redirect('shipper/create')->withErrors($validator)->withInput();
        }else {
            $user = new User;
            $check_code = $user->where('code', $request->code)->first();
            if (!empty($check_code)) {
                return redirect('shop/create')->withErrors(['Mã tài xế đã tồn tại!'])->withInput();
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id)
    {
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
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $validator = \Validator::make($request->all(), [
            'code'            => 'required',
            'name'            => 'required',
            'phone_number'    => 'required',
            'email'           => 'email',
            'home_ward'       => 'required',
            'home_district'   => 'required',
            'home_city'       => 'required',
            'identity_card'   => 'required',
            'vehicle_type_id' => 'required',
            'licence_plate'   => 'required',
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
            $shipper_obj->month_register = $request->month_register;
            $shipper_obj->insurance_level = $request->insurance_level;
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
    public function destroy($id)
    {
        //
    }
    
    public function load_list(Request $request)
    {
        $posts = get_post_datatable($request->all());
        $shipper = new Shipper();
        $data = $shipper->get_all_shippers($posts);
        $length = $shipper->count_all($posts);
        $result = build_json_datatable($data, $length, $posts);
        return $result;
    }
    
    public function check_new_user_duplicate(Request $request)
    {
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
    
    public function check_update_user_duplicate(Request $request)
    {
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
}
