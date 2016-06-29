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
use App\Order;
use App\Feedback;

class ShopRest extends Controller
{
    use NotificationService;
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
            ->orderBy("shop_order_histories.id", "desc")
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
        $order = Order::find($id);

        if (empty($order)) {
            return Response::json(
                array(
                    'accept'   => 0,
                    'messages' => MSG_ORDER_NOT_EXIST,
                ),
                200
            );
        } else {
            $user = User::find(Auth::guard('api')->id());
            if ($user->id == $order->user_id) {
                if($order->status == ORDER_PENDING || $order->status == ORDER_TAKEN_ORDER){
                    $order->status = ORDER_SHOP_CANCEL;
                    $order->shop_cancel_at = Carbon::now()->toDateTimeString();
                    $order->save();
                    if (!empty($order->shipper_id)){
                        $shipper = User::find($order->shipper_id);
                        if (!empty($shipper)){
                            $ios_device_token = $shipper->ios_device_token;
                            $android_device_token = $shipper->gcm_id;
                            if(!empty($ios_device_token)){
                                $this->pushStatusOrder($ios_device_token, "Đơn hàng mã ".$order->code." đã bị hủy!", $order->id);
                            }
                            if (!empty($android_device_token)){
                                $this->send_gcm_notification(array($android_device_token),  "Đơn hàng mã ".$order->code." đã bị hủy!");
                            }
                        }
                    }
                    return Response::json(
                        array(
                            'accept'   => 1,
                            'messages' => MSG_CANCEL_ORDER_SUCCESSFULLY,
                        ),
                        200
                    );
                }else if ($order->status == ORDER_SHOP_CANCEL){
                    return Response::json(
                        array(
                            'accept'   => 0,
                            'messages' => MSG_ORDER_HAVE_BEEN_CANCEL,
                        ),
                        200
                    );
                }else {
                    return Response::json(
                        array(
                            'accept'   => 0,
                            'messages' => MSG_CAN_NOT_CANCEL_ORDER,
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

    public function feedback(Request $request){
        $user = User::find(Auth::guard('api')->id());
        if (!empty($user)) {
            if (empty($request->feedback)) {
                return Response::json(
                    array(
                        'accept'   => 0,
                        'messages' => MSG_FEEDBACK_EMPTY,
                    ),
                    200
                );
            } else {
                if (strlen($request->feedback) >= FEEDBACK_STRING_LIMIT){
                    return Response::json(
                        array(
                            'accept'   => 0,
                            'messages' => MSG_FEEDBACK_STRING_LIMIT,
                        ),
                        200
                    );
                }
                $feedback = new Feedback();
                $feedback->user_id = $user->id;
                $feedback->feedback = $request->feedback;
                $feedback->save();
                return Response::json(
                    array(
                        'accept'   => 1,
                        'messages' => MSG_FEEDBACK_SUCCESSFULLY
                    ),
                    200
                );
            }
        } else {
            return Response::json(
                array(
                    'accept'   => 0,
                    'messages' => MSG_SHOP_NOT_EXIST,
                ),
                200
            );
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
