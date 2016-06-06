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

//use Au;

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
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
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
                            'accept' => 1,
                            'user_type'   => $user->user_type,
                        ),
                        200
                    );
                }
            } else {
                $user->user_type = $request->user_type;
                $user->save();
                return Response::json(
                    array(
                        'accept' => 1,
                        'user_type'   => $user->user_type,
                    ),
                    200
                );
            }
        }
    }

    public function updateOnlineStatus(Request $request){
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
                    'accept'   => 1,
                ),
                200
            );
        }
    }

    public function getMyInfo(){
        $user_id = Auth::guard('api')->id();
        $user = User::find($user_id);
        $type = $user->user_type;
        if($type == SHOP_TYPE){
            $user->shop = Shop::where("user_id", $user_id)
                                ->leftjoin("administrative_units as home_ward",'shops.home_ward_id', '=', 'home_ward.id')
                                ->leftjoin("administrative_units as office_ward",'shops.office_ward_id', '=', 'office_ward.id')
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
                            ->leftjoin("administrative_units as home_ward",'shippers.home_ward_id', '=', 'home_ward.id')
                            ->leftjoin("administrative_units as office_ward",'shippers.office_ward_id', '=', 'office_ward.id')
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

    public function getUserInfo($id){
        $user = User::where("id", $id)->select("id", "name", "phone_number", "identity_card")->first();
        $type = $user->user_type;
        if (empty($user)){
            return Response::json(
                array(
                    'accept' => 0,
                    'user'   => MSG_USER_DO_NOT_EXIST,
                ),
                200
            );
        }else {
            if($type == SHOP_TYPE){
                $user->shop = Shop::where("user_id", $id)
                    ->leftjoin("administrative_units as home_ward",'shops.home_ward_id', '=', 'home_ward.id')
                    ->leftjoin("administrative_units as office_ward",'shops.office_ward_id', '=', 'office_ward.id')
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
                    ->leftjoin("administrative_units as home_ward",'shippers.home_ward_id', '=', 'home_ward.id')
                    ->leftjoin("administrative_units as office_ward",'shippers.office_ward_id', '=', 'office_ward.id')
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
