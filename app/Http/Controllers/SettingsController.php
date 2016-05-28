<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\VehicleType;
use Illuminate\Support\Facades\Redirect;

class SettingsController extends Controller
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

    public function showVehicleTypes(){
        $vehicle_types = VehicleType::all();
        return view('app.settings.vehicle_types',['vehicle_types' => $vehicle_types]);
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

    public function createVehicleType(Request $request){
        $validator = \Validator::make($request->all(), [
            'code'            => 'required|unique:vehicle_types',
            'name'            => 'required|',
        ]);
        if ($validator->fails()) {
            flash_message("Thêm phương tiện không thành công!", "danger");
            return back()->withErrors($validator)->withInput();
        } else {
            $vehicleType = new VehicleType;
            $vehicleType->code = $request->code;
            $vehicleType->name = $request->name;
            $vehicleType->save();
            flash_message("Thêm phương tiện thành công!", "success");
            return redirect()->route('vehicle_types');
        }
    }

    public function editVehicleType(Request $request, $id){
        $validator = \Validator::make($request->all(), [
            'code'            => 'required',
            'name'            => 'required',
        ]);
        if ($validator->fails()) {
            flash_message("Thêm phương tiện không thành công!", "danger");
            return back()->withErrors($validator)->withInput();
        } else {
            $vehicleType = VehicleType::find($id);
            if(empty($vehicleType)){
                return back()->withErrors(["Không tồn tại phương tiện"])->withInput();
            }else {
                $vehicle_tmp = VehicleType::where("id","<>", $id)->where("code", $request->code)->first();
                if (empty($vehicle_tmp)){
                    $vehicleType->code = $request->code;
                    $vehicleType->name = $request->name;
                    $vehicleType->save();
                    flash_message("Sửa phương tiện thành công!", "success");
                    return redirect()->route('vehicle_types');
                }else {
                    return back()->withErrors(["Mã phương tiện đã tồn tại"])->withInput();
                }
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
