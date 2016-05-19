<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Shop;
use Validator;

class ShopsController extends Controller
{
    protected $controller_name = "ShopsController";
    protected $permissions = array(
        "index"  => "Danh sách khách hàng",
        "create" => "Giao diện tạo khách hàng",
        "store"  => "Lưu khách hàng",
        "show"   => "Xem chi tiết khách hàng",
    );
    

    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $user =  User::find(1);
//        $roles = $user->roles;

//        $roles = $user->roles();
//        dd($user->getUserRoles());
//        foreach ($user->roles as $role){
//            dd($role->pivot->user_id);
//        }
        return view('app.shops.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $max_id = User::max('id');
        $shop_code = $max_id + 1;
        return view('app.shops.create', ['shop_code' => $shop_code]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code'            => 'required|max:15|unique:users',
            'name'            => 'required|max:255',
            'password'        => 'required|min:6|confirmed',
            'phone_number'    => 'required|max:15',
            'email'           => 'email|max:255|unique:users',
            'username'        => 'required|max:255|unique:users',
            'home_number'     => 'required|max:255',
            'home_ward'       => 'required|max:255',
            'home_district'   => 'required|max:255',
            'home_city'       => 'required|max:255',
            'office_number'   => 'required|max:255',
            'office_ward'     => 'required|max:255',
            'office_district' => 'required|max:255',
            'office_city'     => 'required|max:255',
            'identity_card'   => 'required|max:12',
        ]);
        if ($validator->fails()) {
            flash_message("Tạo khách hàng mới không thành công!", "danger");
            return redirect('shop/create')->withErrors($validator)->withInput();
        } else {
            $user = new User;
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
            $user->password = bcrypt($request->password);
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
    public function edit($user_id)
    {
        $user = new User;
        $user_obj = $user->find($user_id);
        $shop_obj = $user_obj->shop;
        return view("app/shops/edit", ["user" => $user_obj, "shop" => $shop_obj, "user_id" => $user_id]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request ffgg
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        dd($request->all());
        $validator = \Validator::make($request->all(), [
            'code'            => 'required|max:15|unique:users',
            'name'            => 'required|max:255',
            'phone_number'    => 'required|max:15',
            'email'           => 'email|max:255|unique:users',
            'home_number'     => 'required|max:255',
            'home_ward'       => 'required|max:255',
            'home_district'   => 'required|max:255',
            'home_city'       => 'required|max:255',
            'office_number'   => 'required|max:255',
            'office_ward'     => 'required|max:255',
            'office_district' => 'required|max:255',
            'office_city'     => 'required|max:255',
            'identity_card'   => 'required|max:12',
        ]);
        if ($validator->fails()) {
            flash_message("Sửa khách hàng không thành công!", "danger");
            return back();
        } else {
            $user = new User;
            $user_obj = $user->find($id);
            $user_obj->code = $request->code;
            $user_obj->name = $request->name;
            $user_obj->phone_number = $request->phone_number;
            $user_obj->email = $request->email;
            $user_obj->identity_card = $request->identity_card;
            $user_obj->save();
            $shop_obj = $user_obj->shop;
            $shop_obj->home_ward = $request->home_ward;
            $shop_obj->home_district = $request->home_district;
            $shop_obj->home_city = $request->home_city;
            $shop_obj->office_ward = $request->office_ward;
            $shop_obj->office_district = $request->office_district;
            $shop_obj->office_city = $request->office_city;
            $shop_obj->shop_type = $request->shop_type;
            $shop_obj->profile_status = $request->profile_status;
            $shop_obj->save();
            flash_message("Sửa khách hàng thành công!");
            return redirect()->route('shops');
        }
    }

    /**fi
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function load_list(Request $request)
    {
        $posts = get_post_datatable($request->all());
        $shop = new Shop();
        $data = $shop->get_all_shops($posts);
        $length = $shop->count_all($posts);
        $result = build_json_datatable($data, $length, $posts);
        return $result;
    }

    public function check_user_duplicate(Request $request)
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

}
