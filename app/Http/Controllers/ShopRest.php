<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Shipper;
use App\ShopOrderHistory;
use App\User;
use Validator;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class ShopRest extends Controller
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

    public function getShipperLocation($id)
    {
        $shipper = User::find($id);
        if (empty($shipper)) {
            return Response::json(
                array(
                    'accept'  => 0,
                    'message' => 'Không tồn tại shipper',
                ),
                200
            );
        } else {
            return Response::json(
                array(
                    'accept'    => 1,
                    'longitude' => $shipper->longitude,
                    'latitude'  => $shipper->latitude,
                ),
                200
            );
        }
    }

//    public function

    public function getShipperIntoDistance(Request $request){
        $validator = Validator::make($request->all(), [
            "longitude" => "required",
            "latitude"  => "required",
            "distance" => "required",
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
            DB::enableQueryLog();
            $shippers = DB::table('users')
                ->select(DB::raw('id, name, email, phone_number, latitude, longitude, ( 6371 * acos( cos( radians('.$request->latitude.') ) 
                * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$request->longitude.') ) + 
                sin( radians('.$request->latitude.') ) * sin( radians( latitude ) ) ) ) AS distance'))
                ->where('user_type', SHIPPER_TYPE)
                ->where(DB::raw('TIMESTAMPDIFF(SECOND,lastUpdate,"'.Carbon::now().'")'), '<', TIME_CHECK_ONLINE)
                ->having('distance', '<', $request->distance)->get();
            return Response::json(
                array(
                    'accept'   => 1,
                    'shippers' =>  $shippers,
                ),
                200
            );
        }
    }

    public function getOrders(){
        $shop_id = Auth::guard('api')->id();
        $shop_orders = DB::table('shop_order_histories')
            ->join('orders', 'orders.id', '=', 'shop_order_histories.order_id')
            ->where('shop_order_histories.shop_id', $shop_id)
            ->where('shop_order_histories.deleted_at')
            ->select('orders.*', 'shop_order_histories.id as shop_order_id')
            ->get();
        return Response::json(
            array(
                'accept' => 1,
                'orders' => $shop_orders,
            ),
            200
        );
    }

    public function cancelOrder($id){
        $order = Order::where("id",$id)->select("id","user_id","base_freight","vas_freight","discount_freight","main_freight")
            ->first();
        if (empty($order)) {
            return Response::json(
                array(
                    'accept'   => 1,
                    'messages' => "Đơn hàng không tồn tại!",
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
                                'messages' => "Không tồn tại giá cước!",
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
                        'messages' => "You do not have permission",
                    ),
                    200
                );
            }
        }
    }

    public function deleteShopOrderHistory($id){
        $shopOrderHistory = ShopOrderHistory::find($id);
        if (empty($shopOrderHistory)){
            return Response::json(
                array(
                    'accept' => 0,
                    'message' => 'Lịch sử đơn hàng không tồn tại',
                ),
                200
            );
        }else {
            $shop_id = Auth::guard('api')->id();
            if($shopOrderHistory->shop_id == $shop_id){
                if ($shopOrderHistory->trashed()) {
                    return Response::json(
                        array(
                            'accept' => 0,
                            'message' => 'Lịch sử đơn hàng đã bị xóa trước đó!',
                        ),
                        200
                    );
                }else {
                    $shopOrderHistory->delete();
                    return Response::json(
                        array(
                            'accept' => 1,
                            'message' => 'Xóa lịch sử đơn hàng thành công!',
                        ),
                        200
                    );
                }
            }else{
                return Response::json(
                    array(
                        'accept' => 0,
                        'message' => 'Bạn không có quyền xóa lịch sử đơn hàng!',
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
