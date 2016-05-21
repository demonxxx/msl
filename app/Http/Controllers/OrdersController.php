<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use App\User;
use App\Order;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        dd($request->all());
        $validator = Validator::make($request->all(), [
            "order_type_id"     => "required",
            "vehicle_type_id"   => "required",
            "name"              => "required",
            "recipient_name"    => "required",
            "recipient_phone"   => "required",
            "full_address_to"   => "required",
            "full_address_from" => "required",
            "order_values"      => "required",
        ]);
        if ($validator->fails()) {
            flash_message("Tạo khách hàng mới không thành công!", "danger");
            return redirect('order/create')->withErrors($validator)->withInput();
        } else {
            $user = Auth::user();
            $check_code = $user->where('code', $request->code)->first();
            if (!empty($check_code)) {
                return redirect('shop/create')->withErrors(['Mã khách hàng đã tồn tại!'])->withInput();
            }
            $check_username = $user->where('username', $request->username)->first();
            if (!empty($check_username)) {
                return redirect('shop/create')->withErrors(['Tài khoản đăng nhập đã tồn tại!'])->withInput();
            }
            $check_email = User::where('email', $request->email)->first();
            if (!empty($check_email)) {
                return redirect('shop/create')->withErrors(['Tài khoản email đã tồn tại!'])->withInput();
            }
            $check_phone = User::where('phone_number', $request->phone_number)->first();
            if (!empty($check_phone)) {
                return redirect('shop/create')->withErrors(['Số điện thoại đã tồn tại!'])->withInput();
            }
            $user->code = $request->code;
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->identity_card = $request->identity_card;
            $user->phone_number = $request->phone_number;
            $user->save();
            $shop = new Shop;
            $shop->home_number = $request->home_number;
            $shop->home_ward = $request->home_ward;
            $shop->home_district = $request->home_district;
            $shop->home_city = $request->home_city;
            $shop->office_number = $request->office_number;
            $shop->office_ward = $request->office_ward;
            $shop->office_district = $request->office_district;
            $shop->office_city = $request->office_city;
            $user->shop()->save($shop);
            $shop->office_district = $request->office_district;
            flash_message("Tạo khách hàng mới thành công!");
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function load_list(Request $request) {
        $user_id = $request->user()["id"];
        $posts = get_post_datatable_new($request->all());
        $order = new Order();
        $data = $order->get_all_orders($posts, $user_id);
        $length = $order->count_all($posts, $user_id);
        $result = build_json_datatable_new($data, $length, $posts);
        return $result;
    }
}
