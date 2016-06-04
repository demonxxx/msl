<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Shop;
use App\ShopType;
use App\Adminnistrative_units;
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
    public $breadcrumbs = [];

    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('app.shops.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shoptype = new ShopType;
        $shoptypes = $shoptype->all();
        $cities = Adminnistrative_units::where("level", CITY_UNIT)->get();
        return view('app.shops.create',["shoptypes" => $shoptypes, "cities" => $cities]);
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
            'name'                  => 'required|max:255',
            'password'              => 'required|min:6|confirmed',
            'phone_number'          => 'required|min:10|max:11|unique:users',
            'email'                 => 'required|email|max:255|unique:users',
            'username'              => 'required|max:255|unique:users',
            'shop_name'             => 'max:255',
            'home_number'           => 'max:255',
            'office_number'         => 'required|max:255',
            'office_ward_id'        => 'required',
            'office_district_id'    => 'required',
            'office_city_id'        => 'required',
            'identity_card'         => 'required|min:9|max:12',
        ]);
        if ($validator->fails()) {
            flash_message("Tạo khách hàng mới không thành công!", "danger");
            return redirect('shop/create')->withErrors($validator)->withInput();
        } else {
            $user = new User;
            $max_id = User::max('id')+1;
            $user->code = "U".$max_id;
            $user->name = $request->name;
            $user->username = $request->username;
            $user->password = bcrypt($request->password);
            $user->email = $request->email;
            $user->identity_card = $request->identity_card;
            $user->phone_number = $request->phone_number;
            $user->api_token = str_random(60);
            $user->save();
            $shop = new Shop;
            $max_id = Shop::max('id')+1;
            $shop->code = "KH".$max_id;
            $shop->shop_name = $request->shop_name;
            $shop->home_number = $request->home_number;
            $shop->home_ward = $request->home_ward;
            $shop->home_district = $request->home_district;
            $shop->home_city = $request->home_city;
            $shop->office_number = $request->office_number;
            $shop->office_ward = $request->office_ward;
            $shop->office_district = $request->office_district;
            $shop->office_city = $request->office_city;
            $shop->shop_type_id = $request->shop_type_id;
            $shop->profile_status = 0; // Default value
            $user->shop()->save($shop);
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
        $shoptype = new ShopType;
        $shoptypes = $shoptype->all();
        $cities = Adminnistrative_units::where("level", CITY_UNIT)->get();
        $districts_home = Adminnistrative_units::where("level", DISTRICT_UNIT)->where("parent_id", $shop_obj->home_city_id)->get();
        $wards_home = Adminnistrative_units::where("level",WARD_UNIT)->where("parent_id", $shop_obj->home_district_id)->get();
        $districts_office = Adminnistrative_units::where("level", DISTRICT_UNIT)->where("parent_id", $shop_obj->office_city_id)->get();
        $wards_office = Adminnistrative_units::where("level",WARD_UNIT)->where("parent_id", $shop_obj->office_district_id)->get();
        return view("app/shops/edit", ["user" => $user_obj, "shop" => $shop_obj, "user_id" => $user_id, "shoptypes" => $shoptypes,
            'cities' => $cities, 'districts_home' => $districts_home, 'wards_home' => $wards_home, 
            'districts_office' => $districts_office, 'wards_office' => $wards_office]);

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
        $validator = \Validator::make($request->all(), [
            'name'                      => 'required|max:255',
            'phone_number'              => 'required|min:10|max:11',
            'email'                     => 'required|email|max:255',
            'shop_name'                 => 'max:255',
            'home_number'               => 'max:255',
            'office_number'             => 'required|max:255',
            'office_ward_id'            => 'required',
            'office_district_id'        => 'required',
            'office_city_id'            => 'required',
            'identity_card'             => 'required|min:9|max:12',
        ]);
        if ($validator->fails()) {
            flash_message("Sửa khách hàng không thành công!", "danger");
            return back()->withErrors($validator)->withInput();
        } else {
            $user = new User;
            $user_obj = $user->find($id);
            $user_obj->name = $request->name;
            $user_obj->phone_number = $request->phone_number;
            $user_obj->email = $request->email;
            $user_obj->identity_card = $request->identity_card;
            $user_obj->save();
            $shop_obj = $user_obj->shop;
            $shop_obj->shop_name = $request->shop_name;
            $shop_obj->home_number = $request->home_number;
            $shop_obj->home_ward_id = $request->home_ward_id;
            $shop_obj->home_district_id = $request->home_district_id;
            $shop_obj->home_city_id = $request->home_city_id;
            $shop_obj->office_number = $request->office_number;
            $shop_obj->office_ward_id = $request->office_ward_id;
            $shop_obj->office_district_id = $request->office_district_id;
            $shop_obj->office_city_id = $request->office_city_id;
            $shop_obj->shop_type_id = $request->shop_type_id;
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
