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
        return view('app.shippers.create');
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
            'code' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'email',
            'home_ward' => 'required',
            'home_district' => 'required',
            'home_city' => 'required',
            'identity_card' => 'required',
            'vehicle_type' => 'required',
            'licence_plate' => 'required',
        ]);
        if ($validator->fails()) {
            flash_message("Tạo tài xế mới không thành công!","danger");
            return back();
        }else {
            $user = new User;
            $user->code = $request->code;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            $shipper = new Shipper;
            $shipper->phone = $request->phone;
            $shipper->home_ward = $request->home_ward;
            $shipper->home_district = $request->home_district;
            $shipper->home_city = $request->home_city;
            $shipper->vehicle_type = $request->vehicle_type;
            $shipper->identity_card = $request->identity_card;
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
            'phone'           => 'required',
            'email'           => 'email',
            'home_ward'       => 'required',
            'home_district'   => 'required',
            'home_city'       => 'required',
            'office_ward'       => 'required',
            'office_district'   => 'required',
            'office_city'       => 'required',
            'identity_card'   => 'required',
            'vehicle_type' => 'required',
            'licence_plate' => 'required',
        ]);
        if ($validator->fails()) {
            flash_message("Sửa tài xế không thành công!", "danger");
            return back();
        } else {
            $user = new User;
            $user_obj = $user->find($id);
            $user_obj->code = $request->code;
            $user_obj->name = $request->name;
            $user_obj->email = $request->email;
            $user_obj->save();
            $shipper_obj = $user_obj->shipper;
            $shipper_obj->phone = $request->phone;
            $shipper_obj->home_ward = $request->home_ward;
            $shipper_obj->home_district = $request->home_district;
            $shipper_obj->home_city = $request->home_city;
            $shipper_obj->office_ward = $request->office_ward;
            $shipper_obj->office_district = $request->office_district;
            $shipper_obj->office_city = $request->office_city;
            $shipper_obj->vehicle_type = $request->vehicle_type;
            $shipper_obj->identity_card = $request->identity_card;
            $shipper_obj->licence_plate = $request->licence_plate;
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
}
