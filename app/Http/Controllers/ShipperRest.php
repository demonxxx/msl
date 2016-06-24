<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Gate;
use App\User;
use App\Order;
use App\Shipper;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use App\ShipperOrderHistory;
use App\Account;
use App\TransactionUser;
use App\Transaction;


class ShipperRest extends Controller
{
    use NotificationService;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function updateLocation(Request $request) {
        $validator = Validator::make($request->all(), [
                    "longitude" => "required",
                    "latitude" => "required",
        ]);
        if ($validator->fails()) {
            return Response::json(
                            array(
                        'accept' => 0,
                        'messages' => $validator->messages(),
                            ), 200
            );
        } else {
            $shipper = User::find(Auth::guard('api')->id());
            $shipper->longitude = $request->longitude;
            $shipper->latitude = $request->latitude;
            $shipper->lastUpdate = Carbon::now();
            $shipper->save();
            return Response::json(
                            array(
                        'accept' => 1,
                            ), 200
            );
        }
    }

    public function findByLocation(Request $request) {
        $validator = Validator::make($request->all(), [
                    "longitude" => "required",
                    "latitude" => "required",
                    "distance" => "required",
        ]);
        if ($validator->fails()) {
            return Response::json(
                            array(
                        'accept' => 0,
                        'messages' => $validator->messages(),
                            ), 200
            );
        } else {
            $orders = DB::table('orders')
                            ->join('users', 'users.id', '=', 'orders.user_id')
                            ->select(DB::raw('users.id as owner_id, users.name as owner_name, users.email as owner_email, users.phone_number as owner_phone, orders.* ,
                ( 6371 * acos( cos( radians(' . $request->latitude . '))
                * cos( radians( orders.latitude ) ) * cos( radians( orders.longitude ) - radians(' . $request->longitude . ') ) +
                sin( radians(' . $request->latitude . ') ) * sin( radians( orders.latitude ) ) ) ) AS distance'))
                            ->where('orders.status', ORDER_PENDING)
                            ->having('distance', '<', $request->distance)->orderBy('orders.created_at', 'asc')->get();
            return Response::json(
                            array(
                        'accept' => 1,
                        'orders' => $orders,
                            ), 200
            );
        }
    }

    public function takeOrder($id) {
        $order = Order::find($id);
        if (empty($order)) {
            return Response::json(
                            array(
                        'accept' => 1,
                        'messages' => "Order do not exist!",
                            ), 200
            );
        } else {
            if ($order->status != ORDER_PENDING) {
                return Response::json(
                                array(
                            'accept' => 0,
                            'messages' => "Đơn hàng đã được nhận!",
                                ), 200
                );
            }
            $user_id = Auth::guard('api')->id();
            $user = User::find($user_id);
            if (empty($user)) {
                return Response::json(
                                array(
                            'accept' => 0,
                            'messages' => "Bạn không được nhận đơn hàng này.!",
                                ), 200
                );
            } else {
                $user_account = Account::where("user_id", $user_id)->first();
                if (empty($user_account)){
                    return Response::json(
                        array(
                            'accept' => 0,
                            'message' => "Bạn chưa có tài khoản giao dịch!",
                        ), 200
                    );
                }
                $order_number  = Order::where("shipper_id", $user_id)
                    ->where(function($query)
                    {
                        $query->where("status", ORDER_TAKEN_ORDER)
                            ->orWhere("status", ORDER_TAKEN_ITEMS)
                            ->orWhere("status", ORDER_RETURNING);
                    })
                    ->count();
                if ($order_number > 4){
                    return Response::json(
                        array(
                            'accept' => 0,
                            'message' => "Bạn còn 5 đơn hàng chưa giao, vui lòng giao để nhận thêm đơn hàng mới!",
                        ), 200
                    );
                }
                $total_base_freight_obj = Order::where("shipper_id", $user_id)
                    ->where(function($query)
                    {
                        $query->where("status", ORDER_TAKEN_ORDER)
                            ->orWhere("status", ORDER_TAKEN_ITEMS)
                            ->orWhere("status", ORDER_RETURNING);
                    })
                    ->select(DB::raw('SUM(base_freight) as total'))->first();
                $total_freight = empty($total_base_freight_obj) ? 0 : $total_base_freight_obj->total;
                $total_money = (int) $total_freight + (int) $order->base_freight;
                if($user_account->main < FREIGHT_SHIP * $total_money){
                    return Response::json(
                        array(
                            'accept' => 0,
                            'message' => "Số tiền trong tài khoản của bạn không đủ để nhận đơn hàng, vui lòng nạp thêm để sử dụng!",
                        ), 200
                    );
                }
                $order->shipper_id = $user->id;
                $order->taken_order_at = Carbon::now();
                $order->status = ORDER_TAKEN_ORDER;
                $order->save();
                $shipperOrderHistory = new ShipperOrderHistory;
                $shipperOrderHistory->order_id = $order->id;
                $shipperOrderHistory->shipper_id = $user->id;
                $shipperOrderHistory->save();
                return Response::json(
                                array(
                                    'accept' => 1,
                                    'order' => $order->toArray(),
                                ), 200
                );
            }
        }
    }

    public function getTakenOrder($id){
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
            if ($user->id == $order->shipper_id) {
                $shipperOrderHistory = ShipperOrderHistory::where("shipper_id", $user->id)
                    ->where("order_id", $order->id)
                    ->first();
                if(empty($shipperOrderHistory)){
                    $shipper_order_id = null;
                }else {
                    $shipper_order_id = $shipperOrderHistory->id;
                }
                $order->shipper_order_id = $shipper_order_id;
                $shop = User::where('id', $order->user_id)->select('id', 'name', 'phone_number', 'email')->first();
                return Response::json(
                    array(
                        'accept'  => 1,
                        'order'   => $order->toArray(),
                        'shop' => $shop->toArray(),
                    ),
                    200
                );
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

    public function updateOrderStatusShipper(Request $request, $id) {
        $order = Order::find($id);
        $ios_device_token = null;
        $push_message = null;
        if (empty($order)) {
            return Response::json(
                            array(
                        'accept' => 0,
                        'messages' => "Đơn hàng không tồn tại!",
                            ), 200
            );
        } else {
            $shipper_id = Auth::guard('api')->id();
            if ($shipper_id != $order->shipper_id) {
                return Response::json(array(
                            'accept' => 0,
                            'messages' => 'Bạn không có quyền cập nhật trạng thái.',
                                ), 200
                );
            } else {
                $validator = Validator::make($request->all(), [
                            "status" => "required|numeric",
                ]);
                if ($validator->fails()) {
                    return Response::json(
                                    array(
                                'accept' => 0,
                                'messages' => $validator->messages(),
                                    ), 200
                    );
                } else {
                    $owner = User::find($order->user_id);
                    if (!empty($owner)){
                        $ios_device_token = $owner->ios_device_token;
                    }

                    $status = $request->status;
                    $description = empty($request->description) ? null : $request->description;
                    if ($status == ORDER_PENDING) {
                        if ($order->status == ORDER_PENDING) return;
                        return Response::json(
                                        array(
                                    'accept' => 0,
                                    'messages' => 'Không thể chuyển trạng thái bắt đầu',
                                        ), 200
                        );
                    } else if ($status == ORDER_TAKEN_ORDER) {
                        $order->taken_order_at = Carbon::now()->toDateTimeString();
                        $push_message = "Đơn hàng đã được nhận";
                    } else if ($status == ORDER_TAKEN_ITEMS) {
                        $order->taken_items_at = Carbon::now()->toDateTimeString();
                        $push_message = "Mặt hàng đã được nhận";
                    } else if ($status == ORDER_SHIP_SUCCESS) {
                        if ((int)$order->status == ORDER_SHIP_SUCCESS) return Response::json(
                            array(
                                'accept' => 0,
                                'messages' => 'Đơn hàng đang trong trạng thái chuyển thành công!',
                            ), 200
                        );
                        $isSuccess = $this->shipTransaction($order);
                        if (empty($isSuccess)){
                            return Response::json(
                                array(
                                    'accept' => 0,
                                    'messages' => 'Giao dịch không thành công!',
                                ), 200
                            );
                        }else {
                            $push_message = "Giao hàng thành công";
                            $order->ship_success_at = Carbon::now()->toDateTimeString();
                            $order->status = $status;
                            $order->description = $description;
                            $order->save();
                            if(!empty($ios_device_token)){
                                if (!empty($push_message)){
                                    $this->pushStatusOrder($ios_device_token, $push_message);
                                }
                            }
                            return Response::json(
                                array(
                                    'accept' => 1,
                                    'messages' => array("status" => $status, "description" => $description),
                                    "transaction" => $isSuccess
                                ), 200
                            );
                        }
                    } else if ($status == ORDER_PAYED) {
                        if ($order->status == ORDER_PAYED) return;
                        $order->payed_at = Carbon::now()->toDateTimeString();
                        $push_message = "Thanh toán thành công";
                    } else if ($status == ORDER_RETURNING) {
                        $order->returning_at = Carbon::now()->toDateTimeString();
                        $push_message = "Đơn hàng đang được hoàn lại!";
                    } else if ($status == ORDER_SHOP_CANCEL) {
                        return Response::json(
                            array(
                                'accept' => 0,
                                'messages' => 'Không thể chuyển trạngshop cancel',
                            ), 200
                        );
                    } else if ($status == ORDER_RETURN_ITEMS) {
                        if ((int)$order->status == ORDER_RETURN_ITEMS) return Response::json(
                            array(
                                'accept' => 0,
                                'messages' => 'Đơn hàng đã chuyển trạng thái này!',
                            ), 200
                        );
                        $isSuccess = $this->shipTransaction($order);
                        if (empty($isSuccess)){
                            return Response::json(
                                array(
                                    'accept' => 0,
                                    'messages' => 'Giao dịch không thành công!',
                                ), 200
                            );
                        }else {
                            $push_message = "Hoàn hàng thành công";
                            $order->return_items_at = Carbon::now()->toDateTimeString();
                            $order->status = $status;
                            $order->description = $description;
                            $order->save();
                            if(!empty($ios_device_token)){
                                if (!empty($push_message)){
                                    $this->pushStatusOrder($ios_device_token, $push_message);
                                }
                            }
                            return Response::json(
                                array(
                                    'accept' => 1,
                                    'messages' => array("status" => $status, "description" => $description),
                                    "transaction" => $isSuccess
                                ), 200
                            );
                        }
                    }else {
                        return Response::json(
                            array(
                                'accept' => 0,
                                'messages' => 'Không tồn tại trạng thái đơn hàng',
                            ), 200
                        );
                    }
                    $order->status = $status;
                    $order->description = $description;
                    $order->save();
                    if(!empty($ios_device_token)){
                        if (!empty($push_message)){
                            $this->pushStatusOrder($ios_device_token, $push_message);
                        }
                    }
                    return Response::json(
                        array(
                            'accept' => 1,
                            'messages' => array("status" => $status, "description" => $description),
                        ), 200
                    );
                }
            }
        }
    }

    public function shipTransaction($order){
        $result = [];
        $base_freight = FREIGHT_SHIP * $order->base_freight;
        DB::beginTransaction();
        $isSuccess = true;
        try{
            if (empty($order->shipper_id)) return false;
            $sub = $this->shipTransactionHandle($order->shipper_id, $base_freight , TRANSACTION_TYPE_SUB, "Trừ phí ship", $order->id, $order->base_freight);
            if (!empty($sub)){
                array_push($result, $sub);
            }else {
                $isSuccess = false;
            }
            if ($order->discount_freight > 0){
                $add = $this->shipTransactionHandle($order->shipper_id, $order->discount_freight, TRANSACTION_TYPE_ADD, "Cộng tiền khuyến mại", $order->id, $order->base_freight);
                if (!empty($add)){
                    array_push($result, $add);
                }else {
                    $isSuccess = false;
                }
            }
            if ($isSuccess){
                DB::commit();
            }else {
                return null;
            }
        }catch (\Exception $e)
        {
            DB::rollBack();
            return null;
        }
        return $result;
    }

    public function shipTransactionHandle($userId, $amount, $transactonType, $message = null, $orderId = null, $ship_freight){
        $transaction = new Transaction;
        $transaction->amount = $amount;
        $transaction->transaction_type = $transactonType;
        $transaction->account_type = ACCOUNT_TYPE_MAIN;
        $transaction->note = $message;
        $transaction->transaction_date = Carbon::now()->toDateTimeString();
        $transaction->total_user = 1;
        $transaction->isSystem = 1;
        $transaction->orderId = $orderId;
        $transaction->save();
        $code = "SHIP"."-".$transaction->id;
        $transaction->code = $code;
        $transaction->save();
        $customer_account = Account::where("user_id", $userId)->first();
        if(empty($customer_account)){
            return null;
        }
        $before_transaction = $customer_account->main;
        if ($transactonType == TRANSACTION_TYPE_ADD){
            $customer_account->main = $customer_account->main + (int) $amount;
        }else {
            $customer_account->main = $customer_account->main - (int) $amount;
        }

        $customer_account->save();
        $transactionUser = new TransactionUser;
        $transactionUser->user_id = $userId;
        $transactionUser->transaction_id = $transaction->id;
        $transactionUser->save();
        $transaction->before_transaction = $before_transaction;
        $transaction->ship_freight = $ship_freight;
        $transaction->main = $customer_account->main;
        $transaction->second = $customer_account->second;
        return $transaction;
    }

    public function getTakenOrders() {
        $shipper_id = Auth::guard('api')->id();
        $taken_orders = DB::table('shipper_order_histories')
                ->join('orders', 'orders.id', '=', 'shipper_order_histories.order_id')
                ->where('shipper_order_histories.shipper_id', $shipper_id)
                ->where('shipper_order_histories.deleted_at')
                ->select('orders.*', 'shipper_order_histories.id as shipper_order_id')
                ->orderBy("shipper_order_histories.id", "desc")
                ->get();
        return Response::json(
            array(
                'accept' => 1,
                'orders' => $taken_orders,
            ), 200
        );
    }


    public function deleteShipperOrderHistory($id)
    {
        $shipperOrderHistory = ShipperOrderHistory::find($id);
        if (empty($shipperOrderHistory)) {
            return Response::json(
                array(
                    'accept'  => 0,
                    'message' => 'Lịch sử không tồn tại',
                ),
                200
            );
        } else {
            $shipper_id = Auth::guard('api')->id();
            if ($shipperOrderHistory->shipper_id == $shipper_id) {
                if ($shipperOrderHistory->trashed()) {
                    return Response::json(
                        array(
                            'accept' => 0,
                            'message' => 'Lịch sử nhận đã bị xóa trước đó!',
                        ), 200
                    );
                } else {
                    $shipperOrderHistory->delete();
                    return Response::json(
                                    array(
                                'accept' => 1,
                                'message' => 'Xóa lịch sử nhận thành công!',
                                    ), 200
                    );
                }
            } else {
                return Response::json(
                                array(
                            'accept' => 0,
                            'message' => 'Bạn không có quyền xóa lịch sử nhận đơn hàng!',
                                ), 200
                );
            }
        }
    }

    public function isShipper() {
        $user_id = Auth::guard('api')->id();
        $shipper = Shipper::where('user_id', $user_id)->first();
        if (empty($shipper)) {
            return Response::json(
                            array(
                        'accept' => 1,
                        'isShipper' => 0,
                            ), 200
            );
        } else {
            return Response::json(
                            array(
                        'accept' => 1,
                        'isShipper' => 1,
                            ), 200
            );
        }
    }

}
