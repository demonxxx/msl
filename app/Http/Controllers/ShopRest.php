<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Shipper;
use App\User;
use Validator;
use DB;
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
            $shippers = DB::table('users')
                ->select(DB::raw('id, name, email, phone_number, latitude, longitude, ( 6371 * acos( cos( radians('.$request->latitude.') ) 
                * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$request->longitude.') ) + 
                sin( radians('.$request->latitude.') ) * sin( radians( latitude ) ) ) ) AS distance'))
                ->where('user_type', SHIPPER_TYPE)
                ->where('isOnline', ONLINE)
                ->having('distance', '<', $request->distance)->get();
            return Response::json(
                array(
                    'accept'   => 1,
                    'shippers' => $shippers,
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
