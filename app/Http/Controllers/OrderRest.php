<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Gate;
use App\User;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Response;

class OrderRest extends Controller
{
    use NotificationService;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::guard('api')->id());
        $orders = $user->orders;
        return Response::json(
            array(
                'accept'   => 1,
                'messages' => $orders->toArray(),
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
        //
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
            "order_type_id"     => "required|numeric",
            "vehicle_type_id"   => "required|numeric",
            "name"              => "required",
            "recipient_name"    => "required",
            "recipient_phone"   => "required|numeric",
            "full_address_to"   => "required",
            "full_address_from" => "required",
            "order_values"      => "required",
            "longitude"         => "required",
            "latitude"          => "required"
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
            $user = User::find(Auth::guard('api')->id());
            $order_count = Order::max('id');
            $order_code = "OD" . ($order_count + 1);
            $order = new Order;
            $order->code = $order_code;
            $order->order_type_id = $request->order_type_id;
            $order->vehicle_type_id = $request->vehicle_type_id;
            $order->name = $request->name;
            $order->recipient_name = $request->recipient_name;
            $order->recipient_phone = $request->recipient_phone;
            $order->full_address_to = $request->full_address_to;
            $order->full_address_from = $request->full_address_from;
            $order->order_values = $request->order_values;
            $order->longitude = $request->longitude;
            $order->latitude = $request->latitude;
            $order->description = $request->description;
            $user->orders()->save($order);

            // run push notification service
            $this->pushOrderNotification($order);

            return Response::json(
                array(
                    'accept'   => 1,
                    'messages' => $order->toArray(),
                ),
                200
            );
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
            $user = User::find(Auth::guard('api')->id());
            if ($user->id == $order->user_id) {
                return Response::json(
                    array(
                        'accept'   => 1,
                        'messages' => $order->toArray(),
                    ),
                    200
                );
            } else {
                return Response::json(
                    array(
                        'accept'   => 0,
                        'messages' => "You do not have permission",
                    ),
                    200
                );
            }
        }
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
            $user = User::find(Auth::guard('api')->id());

            if ($user->id == $order->user_id) {
                $validator = Validator::make($request->all(), [
                    "order_type_id"     => "required|numeric",
                    "vehicle_type_id"   => "required|numeric",
                    "name"              => "required",
                    "recipient_name"    => "required",
                    "recipient_phone"   => "required|numeric",
                    "full_address_to"   => "required",
                    "full_address_from" => "required",
                    "order_values"      => "required",
                    "longitude"         => "required",
                    "latitude"          => "required"
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
                    $order->order_type_id = $request->order_type_id;
                    $order->vehicle_type_id = $request->vehicle_type_id;
                    $order->name = $request->name;
                    $order->recipient_name = $request->recipient_name;
                    $order->recipient_phone = $request->recipient_phone;
                    $order->full_address_to = $request->full_address_to;
                    $order->full_address_from = $request->full_address_from;
                    $order->order_values = $request->order_values;
                    $order->longitude = $request->longitude;
                    $order->latitude = $request->latitude;
                    $order->description = $request->description;
                    $user->orders()->save($order);
                    return Response::json(
                        array(
                            'accept'   => 1,
                            'messages' => $order->toArray(),
                        ),
                        200
                    );
                }
            }else {
                return Response::json(
                    array(
                        'accept'   => 0,
                        'messages' => "You do not have permission",
                    ),
                    200
                );
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        //
    }
}
