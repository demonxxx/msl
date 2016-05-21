<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Gate;
use App\User;
use App\Order;
use App\Order_shipper;
use Illuminate\Support\Facades\Auth;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

class ShipperRest extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function findByLocation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "longitude" => "required",
            "latitude"  => "required",
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
            $orders = Order::where('status', ORDER_PENDING)->get();
            foreach ($orders as $order) {
                $user = User::find($order->user_id);
                $user_result = array("name"         => $user->name,
                                     "email"        => $user->email,
                                     "phone_number" => $user->phone_number);
                $order->user = $user_result;
            }
            return Response::json(
                array(
                    'accept'   => 1,
                    'messages' => $orders->toArray(),
                ),
                200
            );
        }
    }

    public function takeOrder($id)
    {
        $order = Order::find($id);
        if (empty($order)) {
            return Response::json(
                array(
                    'accept'   => 1,
                    'messages' => "Order do not exist!",
                ),
                200
            );
        } else {
            if($order->status == ORDER_TAKEN){
                return Response::json(
                    array(
                        'accept'   => 0,
                        'messages' => "Đơn hàng đã được nhận!",
                    ),
                    200
                );
            }
            $owner_tmp = User::find($order->user_id);
            if (!empty($owner_tmp)) {
                $owner = array("email"        => $owner_tmp->email,
                               "phone_number" => $owner_tmp->phone_number,
                               "id"           => $owner_tmp->id,
                );
            }
            $user = User::find(Auth::guard('api')->id());
            if (empty($user)) {
                return Response::json(
                    array(
                        'accept'   => 1,
                        'messages' => "User do not exist!",
                    ),
                    200
                );
            } else {
                $order_shipper = new Order_shipper;
                $order_shipper->user_id = $user->id;
                $order_shipper->order_id = $order->id;
                $order_shipper->take_at = Carbon::now();
                $order_shipper->save();
                $order->status = ORDER_TAKEN;
                $order->save();
                return Response::json(
                    array(
                        'accept'        => 1,
                        'order'         => $order->toArray(),
                        'owner'         => $owner,
                        'order_shipper' => $order_shipper->toArray(),
                    ),
                    200
                );
            }
        }
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
}
