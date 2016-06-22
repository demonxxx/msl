<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Shipper;
use App\Http\Requests;
use App\Shop;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Facades\Response;
use App\AddedService;
use App\VehicleType;
use App\Adminnistrative_units;
use App\Avatar;
use Illuminate\Support\Str;
use App\Account;

class UserRest extends Controller
{
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function login(Request $request)
        {
                if (Auth::check()) {
                        $user = Auth::user();
                        $info = $user->shop;
                        $user->isOnline = ONLINE;
                        $user->save();
                        return Response::json(
                                array(
                                        'accept' => 1,
                                        'user'   => Auth::user()->toArray(),
                                        'info'   => $info
                                ),
                                200
                        );              
                } else {
                        $validator = Validator::make($request->all(), [
                            "password" => "required",
                                "email" => "required"
                        ]);
                        if ($validator->fails()) {
                                return Response::json(
                                    array(
                                        'accept'   => 0,
                                        'messages' => $validator->messages(),
                                    ),
                                    200
                                );
                        } else {
                                $field = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';
                                $request->merge([$field => $request->input('email')]);
                                if (Auth::attempt($request->only($field, 'password'))) {
                                        $user = Auth::user();
                                        $info = $user->shop;
                                        $user->isOnline = ONLINE;
                                        $user->save();
                                        return Response::json(
                                            array(
                                                'accept' => 1,
                                                'user'   => Auth::user()->toArray(),
                                                'info'   => $info
                                            ),
                                            200
                                        );
                                } else {
                                        return Response::json(
                                            array(
                                                'accept' => 0,
                                            ),
                                            200
                                        );
                                }
                        }
                }
        }

        public function getAccountInfo(){
                $user_id = Auth::guard('api')->id();
                $customer_account = Account::where("user_id", $user_id)->select("main", "second")->first();
                if(empty($customer_account)){
                        return Response::json(
                            array(
                                'accept' => 1,
                                'account' => "Bạn chưa có tài khoản giao dịch!",
                            ),
                            200
                        );
                }
                return Response::json(
                    array(
                        'accept' => 1,
                        'account' => $customer_account->toArray(),
                    ),
                    200
                );
        }

        public function logout()
        {
                if (Auth::check()) {
                        $user = Auth::user();
                        $user->isOnline = OFFLINE;
                        $user->save();
                        Auth::logout();
                        return Response::json(
                                array(
                                        'accept' => 1,
                                ),
                                200
                        );
                } else {
                        return Response::json(
                                array(
                                        'accept' => 1,
                                ),
                                200
                        );
                }
        }

        public function changeUserType(Request $request)
        {
                $validator = Validator::make($request->all(), [
                        "user_type" => "required|integer|between:1,2",
                ]);
                if ($validator->fails()) {
                        return Response::json(
                                array(
                                        'accept'   => 0,
                                        'messages' => $validator->messages(),
                                ),
                                200
                        );
                } else {
                        $user_id = Auth::guard('api')->id();
                        $user = User::find($user_id);
                        if ($request->user_type == SHIPPER_TYPE) {
                                $shipper = Shipper::where('user_id', $user_id)->first();
                                if (empty($shipper)) {
                                        return Response::json(
                                                array(
                                                        'accept'   => 0,
                                                        'messages' => "Bạn chưa là shipper",
                                                ),
                                                200
                                        );
                                } else {
                                        $user->user_type = $request->user_type;
                                        $user->save();
                                        return Response::json(
                                                array(
                                                        'accept'    => 1,
                                                        'user_type' => $user->user_type,
                                                ),
                                                200
                                        );
                                }
                        } else {
                                $user->user_type = $request->user_type;
                                $user->save();
                                return Response::json(
                                        array(
                                                'accept'    => 1,
                                                'user_type' => $user->user_type,
                                        ),
                                        200
                                );
                        }
                }
        }

        public function updateOnlineStatus(Request $request)
        {
                $user_id = Auth::guard('api')->id();
                $user = User::find($user_id);
                $validator = Validator::make($request->all(), [
                        "status" => "required|integer|between:0,1",
                ]);
                if ($validator->fails()) {
                        return Response::json(
                                array(
                                        'accept'   => 0,
                                        'messages' => $validator->messages(),
                                ),
                                200
                        );
                } else {
                        $user->isOnline = $request->status;
                        $user->save();
                        return Response::json(
                                array(
                                        'accept' => 1,
                                ),
                                200
                        );
                }

        }

        public function changePassword(Request $request){
                $user_id = Auth::guard('api')->id();
                $user = User::find($user_id);
                $validator = Validator::make($request->all(), [
                    "password" => "required|min:6|confirmed",
                ]);
                if ($validator->fails()) {
                        return Response::json(
                            array(
                                'accept'   => 0,
                                'messages' => $validator->messages(),
                            ),
                            200
                        );
                }
                $user->forceFill([
                    'password' => bcrypt($request->password),
                    'remember_token' => Str::random(60),
                ])->save();
                return Response::json(
                    array(
                        'accept'   => 1,
                        'messages' => "Đổi mật khẩu thành công!",
                    ),
                    200
                );
        }

        public function getMyInfo()
        {
                $user_id = Auth::guard('api')->id();
                $user = User::find($user_id);
                $type = $user->user_type;
                if ($type == SHOP_TYPE) {
                        $user->shop = Shop::where("user_id", $user_id)
                                ->leftjoin("administrative_units as home_ward", 'shops.home_ward_id', '=', 'home_ward.id')
                                ->leftjoin("administrative_units as office_ward", 'shops.office_ward_id', '=', 'office_ward.id')
                                ->where("home_ward.deleted_at")
                                ->where("office_ward.deleted_at")
                                ->select("shops.*", "home_ward.name as home_ward_name", "home_ward.id as home_ward_id", "office_ward.name as office_ward_name",
                                        "office_ward.id as office_ward_id")->first();
                        return Response::json(
                                array(
                                        'accept' => 1,
                                        'user'   => $user,
                                ),
                                200
                        );
                } else {
                        $user->shipper = Shipper::where("user_id", $user_id)
                                ->leftjoin("administrative_units as home_ward", 'shippers.home_ward_id', '=', 'home_ward.id')
                                ->leftjoin("administrative_units as office_ward", 'shippers.office_ward_id', '=', 'office_ward.id')
                                ->where("home_ward.deleted_at")
                                ->where("office_ward.deleted_at")
                                ->select("shippers.*", "home_ward.name as home_ward_name", "home_ward.id as home_ward_id", "office_ward.name as office_ward_name",
                                        "office_ward.id as office_ward_id")->first();;
                        return Response::json(
                                array(
                                        'accept' => 1,
                                        'user'   => $user,
                                ),
                                200
                        );
                }
        }

        public function getUserInfo($id)
        {
                $user = User::where("id", $id)->select("id", "name", "user_type", "email", "longitude", "latitude", "lastUpdate", "phone_number", "identity_card")->first();
                $type = $user->user_type;
                if (empty($user)) {
                        return Response::json(
                                array(
                                        'accept' => 0,
                                        'user'   => MSG_USER_DO_NOT_EXIST,
                                ),
                                200
                        );
                } else {
                        if ($type == SHOP_TYPE) {
                                $user->shop = Shop::where("user_id", $id)
                                        ->leftjoin("administrative_units as home_ward", 'shops.home_ward_id', '=', 'home_ward.id')
                                        ->leftjoin("administrative_units as office_ward", 'shops.office_ward_id', '=', 'office_ward.id')
                                        ->where("home_ward.deleted_at")
                                        ->where("office_ward.deleted_at")
                                        ->select("shops.*", "home_ward.name as home_ward_name", "home_ward.id as home_ward_id", "office_ward.name as office_ward_name",
                                                "office_ward.id as office_ward_id")->first();;
                                return Response::json(
                                        array(
                                                'accept' => 1,
                                                'user'   => $user,
                                        ),
                                        200
                                );
                        } else {
                                $user->shipper = Shipper::where("user_id", $id)
                                        ->leftjoin("administrative_units as home_ward", 'shippers.home_ward_id', '=', 'home_ward.id')
                                        ->leftjoin("administrative_units as office_ward", 'shippers.office_ward_id', '=', 'office_ward.id')
                                        ->where("home_ward.deleted_at")
                                        ->where("office_ward.deleted_at")
                                        ->select("shippers.*", "home_ward.name as home_ward_name", "home_ward.id as home_ward_id", "office_ward.name as office_ward_name",
                                                "office_ward.id as office_ward_id")->first();
                                return Response::json(
                                        array(
                                                'accept' => 1,
                                                'user'   => $user,
                                        ),
                                        200
                                );
                        }
                }
        }

        public function updateMyInfo(Request $request)
        {
                $user_id = Auth::guard('api')->id();
                $user = User::find($user_id);
                $type = $user->user_type;
                if ($type == SHOP_TYPE) {
                        $validator = Validator::make($request->all(), [
                                'name'          => 'max:255',
                                'phone_number'  => 'min:10|max:14',
                                'identity_card' => 'min:9|max:14',
                                'shop_name'     => 'max:255',
                                'home_number'   => 'max:255',
                                'office_number' => 'max:255',
                                'email'         => 'email',
                                'isActive'      => 'integer|between:0,3',
                        ]);
                        if ($validator->fails()) {
                                return Response::json(
                                        array(
                                                'accept'   => 0,
                                                'messages' => $validator->messages(),
                                        ),
                                        200
                                );
                        } else {
                                $errors = [];
                                $isError = 0;
                                if (!empty($request->phone_number)) {
                                        $user_tmp = User::where("id", "<>", $user_id)->where("phone_number", $request->phone_number)->first();
                                        if (!empty($user_tmp)) {
                                                $isError = 1;
                                                array_push($errors, MSG_PHONE_NUMBER_EXIST);
                                        }
                                }
                                if (!empty($request->email)) {
                                        $user_tmp = User::where("id", "<>", $user_id)->where("email", $request->email)->first();
                                        if (!empty($user_tmp)) {
                                                $isError = 1;
                                                array_push($errors, MSG_EMAIL_EXIST);
                                        }
                                }
                                if ($isError == 1) {
                                        return Response::json(
                                                array(
                                                        'accept'   => 0,
                                                        'messages' => $errors,
                                                ),
                                                200
                                        );
                                }
                                $user->email = !empty($request->email) ? $request->email : $user->email;
                                $user->name = !empty($request->name) ? $request->name : $user->name;
                                $user->phone_number = !empty($request->phone_number) ? $request->phone_number : $user->phone_number;
                                $user->identity_card = !empty($request->identity_card) ? $request->identity_card : $user->identity_card;
                                $shop = $user->shop;
                                if (!empty($shop)) {
                                        $shop->isActive = !empty($request->isActive) ? $request->isActive : $shop->isActive;
                                        $shop->shop_name = !empty($request->shop_name) ? $request->shop_name : $shop->shop_name;
                                        $shop->home_number = !empty($request->home_number) ? $request->home_number : $shop->home_number;
                                        $shop->office_number = !empty($request->office_number) ? $request->office_number : $shop->office_number;
                                        $shop->home_ward = !empty($request->home_ward) ? $request->home_ward : $shop->home_ward;
                                        $shop->home_ward_id = !empty($request->home_ward_id) ? $request->home_ward_id : $shop->home_ward_id;
                                        $shop->office_ward = !empty($request->office_ward) ? $request->office_ward : $shop->office_ward;
                                        $shop->office_ward_id = !empty($request->office_ward_id) ? $request->office_ward_id : $shop->office_ward_id;
                                        $shop->home_full_address = !empty($request->home_full_address) ? $request->home_full_address : $shop->home_full_address;
                                        $shop->office_full_address = !empty($request->office_full_address) ? $request->office_full_address : $shop->office_full_address;
                                        $shop->save();
                                }
                                $user->save();
                                $user->shop = $shop;
                                return Response::json(
                                        array(
                                                'accept'   => 1,
                                                'messages' => $user,
                                        ),
                                        200
                                );
                        }
                } else {
                        $validator = Validator::make($request->all(), [
                                'name'            => 'max:255',
                                'phone_number'    => 'min:10|max:11',
                                'identity_card'   => 'min:9|max:12',
                                'shop_name'       => 'max:255',
                                'home_number'     => 'max:255',
                                'email'           => 'email',
                                'isActive'        => 'integer|between:0,3',
                                'vehicle_type_id' => 'integer'
                        ]);
                        if ($validator->fails()) {
                                return Response::json(
                                        array(
                                                'accept'   => 0,
                                                'messages' => $validator->messages(),
                                        ),
                                        200
                                );
                        } else {
                                $errors = [];
                                $isError = 0;
                                if (!empty($request->phone_number)) {
                                        $user_tmp = User::where("id", "<>", $user_id)->where("phone_number", $request->phone_number)->first();
                                        if (!empty($user_tmp)) {
                                                $isError = 1;
                                                array_push($errors, MSG_PHONE_NUMBER_EXIST);
                                        }
                                }
                                if (!empty($request->email)) {
                                        $user_tmp = User::where("id", "<>", $user_id)->where("email", $request->email)->first();
                                        if (!empty($user_tmp)) {
                                                $isError = 1;
                                                array_push($errors, MSG_EMAIL_EXIST);
                                        }
                                }
                                if ($isError == 1) {
                                        return Response::json(
                                                array(
                                                        'accept'   => 0,
                                                        'messages' => $errors,
                                                ),
                                                200
                                        );
                                }
                                $user->email = !empty($request->email) ? $request->email : $user->email;
                                $user->name = !empty($request->name) ? $request->name : $user->name;
                                $user->phone_number = !empty($request->phone_number) ? $request->phone_number : $user->phone_number;
                                $user->identity_card = !empty($request->identity_card) ? $request->identity_card : $user->identity_card;
                                $shipper = $user->shipper;
                                if (!empty($shipper)) {
                                        $shipper->isActive = !empty($request->isActive) ? $request->isActive : $shipper->isActive;
                                        $shipper->home_number = !empty($request->home_number) ? $request->home_number : $shipper->home_number;
                                        $shipper->office_number = !empty($request->office_number) ? $request->office_number : $shipper->office_number;
                                        $shipper->home_ward = !empty($request->home_ward) ? $request->home_ward : $shipper->home_ward;
                                        $shipper->home_ward_id = !empty($request->home_ward_id) ? $request->home_ward_id : $shipper->home_ward_id;
                                        $shipper->office_ward = !empty($request->office_ward) ? $request->office_ward : $shipper->office_ward;
                                        $shipper->office_ward_id = !empty($request->office_ward_id) ? $request->office_ward_id : $shipper->office_ward_id;
                                        $shipper->licence_plate = !empty($request->licence_plate) ? $request->licence_plate : $shipper->licence_plate;
                                        $shipper->licence_driver_number = !empty($request->licence_driver_number) ? $request->licence_driver_number : $shipper->licence_driver_number;
                                        $shipper->vehicle_type_id = !empty($request->vehicle_type_id) ? $request->vehicle_type_id : $shipper->vehicle_type_id;
                                        $shipper->home_full_address = !empty($request->home_full_address) ? $request->home_full_address : $shipper->home_full_address;
                                        $shipper->office_full_address = !empty($request->office_full_address) ? $request->office_full_address : $shipper->office_full_address;
                                        $shipper->save();
                                }

                                $user->save();
                                $user->shipper = $shipper;
                                return Response::json(
                                        array(
                                                'accept'   => 1,
                                                'messages' => $user,
                                        ),
                                        200
                                );
                        }
                }
        }

        public function loadLocations()
        {
                $locations = Adminnistrative_units::all();

                return Response::json(
                        array(
                                "accept"    => 1,
                                "locations" => $locations->toArray()
                        ),
                        200
                );
        }

        public function loadAddedServices(){
                return Response::json(
                        array(
                                "accept"    => 1,
                                "added_services" => AddedService::all()->toArray()
                        ),
                        200
                );

        }

        public function loadVehicleTypes(){
                return Response::json(
                        array(
                                "accept"    => 1,
                                "vehicle_types" => VehicleType::all()->toArray()
                        ),
                        200
                );
        }

        
        public function uploadAvatar(Request $request){
            $file = $request->file('photo');
            $user = User::find(Auth::guard('api')->id());
            if (!empty($user)) {
                if (!empty($file)) {
                    if ($file->getClientSize() >= AVATAR_SIZE*1000000) {
                        return Response::json(
                            array(
                                'accept'   => 0,
                                'messages' => MSG_UPLOAD_FILE_SIZE,
                            ),
                           200
                        );
                    } else if ($file->getClientSize() == 0) {
                        return Response::json(
                            array(
                                'accept'   => 0,
                                'messages' => MSG_UPLOAD_WRONG_IMAGE_TYPE,
                            ),
                           200
                        );
                    }
                }
                else {
                    return Response::json(
                        array(
                            'accept'   => 0,
                            'messages' => MSG_UPLOAD_FILE_EMPTY,
                        ),
                       200
                    );
                }
                if ($file->isValid()) {
                    $file->move(UPLOAD_AVATAR_DIR, $user->id."_avatar.jpg");
                    $avatar = Avatar::where('user_id', '=', $user->id)->first();
                    if (empty($avatar)) {
                        $avatar = new Avatar();
                        $avatar->user_id = $user->id;
                        $avatar->name = $user->id."_avatar.jpg";
                        $avatar->save();
                    }
                    
                    return Response::json(
                        array(
                            'accept'   => 1,
                            'messages' => MSG_UPLOAD_FILE_SUCCEEDED,
                        ),
                       200
                    );
                } else {
                    return Response::json(
                        array(
                            'accept'   => 0,
                            'messages' => MSG_UPLOAD_FILE_FAILED,
                        ),
                       200
                    );
                }
            } else {
                return Response::json(
                    array(
                        'accept'   => 0,
                        'messages' => MSG_USER_DO_NOT_EXIST,
                    ),
                    200
                );
            }
        }
        
        public function index()
        {
                //
                return Response::json(
                        array(
                                'values' => "User index",
                        ),
                        200
                );
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
                return Response::json(
                        array(
                                'values' => "Create User",
                        ),
                        200
                );
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
                return Response::json(
                        array(
                                'values' => "Store User",
                        ),
                        200
                );
        }

        /**
         * Display the specified resource.
         *
         * @param  int $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
                return Response::json(
                        array(
                                'values' => "Show an User",
                        ),
                        200
                );
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
                return Response::json(
                        array(
                                'values' => "Edit info User",
                        ),
                        200
                );
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
                return Response::json(
                        array(
                                'values' => "Update info  User",
                        ),
                        200
                );
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
                return Response::json(
                        array(
                                'values' => "Deletes User",
                        ),
                        200
                );
        }
}
