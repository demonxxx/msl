<?php

namespace App\Http\Controllers;

use App\Distance_freights;
use Illuminate\Http\Request;

use App\Http\Requests;
use Gate;
use App\User;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\ShopOrderHistory;
use Illuminate\Support\Facades\Response;
use App\VehicleType;
use App\OrderType;

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
            "recipient_name"    => "required",
            "recipient_phone"   => "required|numeric",
            "full_address_to"   => "required",
            "full_address_from" => "required",
            "order_values"      => "required",
            "longitude"         => "required",
            "latitude"          => "required",
            "start_time"        => "date",
            "end_time"        => "date"
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
            $order->start_time = empty($request->start_time) ? null : $request->start_time;
            $order->end_time = empty($request->end_time) ? null : $request->end_time;
            $user->orders()->save($order);
            $shopOrderHistory = new ShopOrderHistory;
            $shopOrderHistory->shop_id = $user->id;
            $shopOrderHistory->order_id = $order->id;
            $shopOrderHistory->save();
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
                    'messages' => MSG_ORDER_NOT_EXIST,
                ),
                200
            );
        } else {
            $user = User::find(Auth::guard('api')->id());
            if ($user->id == $order->user_id) {
                if ($order->status == ORDER_PENDING) {
                    return Response::json(
                        array(
                            'accept' => 1,
                            'order'  => $order->toArray(),
                        ),
                        200
                    );
                } else {
                    $shipper = User::where('id', $order->shipper_id)->select('id', 'name', 'phone_number', 'email')->first();
                    if (!empty($shipper)) {
                        return Response::json(
                            array(
                                'accept'  => 1,
                                'order'   => $order->toArray(),
                                'shipper' => $shipper->toArray(),
                            ),
                            200
                        );
                    } else {
                        return Response::json(
                            array(
                                'accept' => 1,
                                'order'  => $order->toArray(),
                            ),
                            200
                        );
                    }
                }
            } else {
                return Response::json(
                    array(
                        'accept'   => 0,
                        'messages' => MSG_NOT_HAVE_PERMISSION,
                    ),
                    200
                );
            }
        }
    }

    public function getOrderTaken($id)
    {
        $order = Order::find($id);
        if (empty($order)) {
            return Response::json(
                array(
                    'accept'   => 1,
                    'messages' => MSG_ORDER_NOT_EXIST,
                ),
                200
            );
        } else {
            $user = User::find(Auth::guard('api')->id());
            if ($user->id == $order->user_id) {
                if ($order->status == ORDER_PENDING) {
                    return Response::json(
                        array(
                            'accept' => 1,
                            'order'  => $order->toArray(),
                        ),
                        200
                    );
                } else {
                    $shipper = User::where('id', $order->shipper_id)->select('id', 'name', 'phone_number', 'email')->first();
                    if (!empty($shipper)) {
                        return Response::json(
                            array(
                                'accept'  => 1,
                                'order'   => $order->toArray(),
                                'shipper' => $shipper->toArray(),
                            ),
                            200
                        );
                    } else {
                        return Response::json(
                            array(
                                'accept' => 1,
                                'order'  => $order->toArray(),
                            ),
                            200
                        );
                    }
                }
            } else {
                return Response::json(
                    array(
                        'accept'   => 0,
                        'messages' => MSG_NOT_HAVE_PERMISSION,
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
                    'messages' => MSG_ORDER_NOT_EXIST,
                ),
                200
            );
        } else {
            $user = User::find(Auth::guard('api')->id());

            if ($user->id == $order->user_id) {
                $validator = Validator::make($request->all(), [
                    "order_type_id"     => "required|numeric",
                    "vehicle_type_id"   => "required|numeric",
                    "recipient_name"    => "required",
                    "recipient_phone"   => "required|numeric",
                    "full_address_to"   => "required",
                    "full_address_from" => "required",
                    "order_values"      => "required|numeric",
                    "longitude"         => "required|numeric",
                    "latitude"          => "required|numeric"
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
            } else {
                return Response::json(
                    array(
                        'accept'   => 0,
                        'messages' => MSG_NOT_HAVE_PERMISSION,
                    ),
                    200
                );
            }
        }
    }

    public function freightBaseDistance(Request $request, $id){
        $order = Order::where("id",$id)->select("id","user_id","base_freight","vas_freight","discount_freight","main_freight")
            ->first();
        if (empty($order)) {
            return Response::json(
                array(
                    'accept'   => 1,
                    'messages' => MSG_ORDER_NOT_EXIST,
                ),
                200
            );
        } else {
            $user = User::find(Auth::guard('api')->id());
            if ($user->id == $order->user_id) {
                $validator = Validator::make($request->all(), [
                    "vehicle_type_id"  => "required|numeric",
                    "distance"   => "required|numeric",
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
                    $base_freight_obj = Distance_freights::where("vehicle_type_id",$request->vehicle_type_id)
                                    ->where("from", "<=", $request->distance)
                                    ->where("to", ">=", $request->distance)
                                    ->first();
                    if(empty($base_freight_obj)){
                        return Response::json(
                            array(
                                'accept'   => 0,
                                'messages' => MSG_DISTANCE_FREIGHT_NOT_EXIST,
                            ),
                            200
                        );
                    }else {
                        $base_freight = $base_freight_obj->freight;
                        $vas_freight = $order->vas_freight;
                        $discount_freight = $order->discount_freight;
                        $main_freight = (int) (($base_freight + $vas_freight) - $discount_freight);
                        $order->main_freight = $main_freight;
                        $order->base_freight = $base_freight;
                        $order->distance = $request->distance;
                        $order->vehicle_type_id = $request->vehicle_type_id;
                        $order->save();
                        return Response::json(
                            array(
                                'accept'   => 1,
                                'messages' => $order->toArray(),
                            ),
                            200
                        );
                    }
                }
            } else {
                return Response::json(
                    array(
                        'accept'   => 0,
                        'messages' => MSG_NOT_HAVE_PERMISSION,
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
    public function destroy($id)
    {
        //
    }
}
