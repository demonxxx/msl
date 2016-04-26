<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use App\Shop;

use App\Helpers\helpers;

class ShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $shops = Shop::all();
        return view('app.shops.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.shops.create'  );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(),  [
            'code' => 'email',
            'name' => 'email',
            'phone' => 'required',
            'email' => 'email',
            'home_ward' => 'required',
            'home_district' => 'required',
            'home_city' => 'required',
            'office_ward' => 'required',
            'office_district' => 'required',
            'office_city' => 'required',
            'id_card' => 'required',
        ]);
        if ($validator->fails()) {
            flash("Tạo khách hàng mới không thành công!","danger");
            return back();
        }else {
            $user = new User;
            $user->code = $request->code;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            $shop = new Shop;
            $shop->full_name = $request->name;
            $shop->home_address = $request->home_ward.$request->home_district.$request->home_city;
            $shop->office_address = $request->office_ward.$request->office_district.$request->office_city;
            $user->shop()->save($shop);
            flash("Tạo khách hàng mới thành công!");
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
