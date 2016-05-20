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

    public function updateOrderStatus(){
        
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
