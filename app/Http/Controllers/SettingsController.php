<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\VehicleType;
use App\AddedService;
use Illuminate\Support\Facades\Auth;
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

    public function showVehicleTypes()
    {
        $vehicle_types = VehicleType::all();
        return view('app.settings.vehicle_types', ['vehicle_types' => $vehicle_types]);
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

    public function createVehicleType(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'code' => 'required|unique:vehicle_types',
            'name' => 'required|',
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


    public function editVehicleType(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'code' => 'required',
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            flash_message("Thêm phương tiện không thành công!", "danger");
            return back()->withErrors($validator)->withInput();
        } else {
            $vehicleType = VehicleType::find($id);
            if (empty($vehicleType)) {
                return back()->withErrors(["Không tồn tại phương tiện"])->withInput();
            } else {
                $vehicle_tmp = VehicleType::where("id", "<>", $id)->where("code", $request->code)->first();
                if (empty($vehicle_tmp)) {
                    $vehicleType->code = $request->code;
                    $vehicleType->name = $request->name;
                    $vehicleType->save();
                    flash_message("Sửa phương tiện thành công!", "success");
                    return redirect()->route('vehicle_types');
                } else {
                    return back()->withErrors(["Mã phương tiện đã tồn tại"])->withInput();
                }
            }
        }
    }

    public function showAddedServices()
    {
        $added_services = DB::table('added_services')
            ->join('vehicle_types', 'added_services.vehicle_type_id', '=', 'vehicle_types.id')
            ->where('added_services.deleted_at')
            ->where('vehicle_types.deleted_at')
            ->select('added_services.*', 'vehicle_types.name as vehicle_name')->get();

        $vehicle_types = VehicleType::all();
        return view('app.settings.added_service', ['added_services' => $added_services, 'vehicle_types' => $vehicle_types]);
    }

    public function createAddedService(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'code'            => 'required|unique:added_services',
            'name'            => 'required',
            'vehicle_type_id' => 'required|integer',
            'freight'         => 'required'
        ]);
        if ($validator->fails()) {
            flash_message("Thêm dịch vụ không thành công!", "danger");
            return back()->withErrors($validator)->withInput();
        } else {
            $added_service = new AddedService;
            $added_service->code = $request->code;
            $added_service->name = $request->name;
            $added_service->vehicle_type_id = $request->vehicle_type_id;
            $added_service->freight = $request->freight;
            $added_service->save();
            flash_message("Thêm dịch vụ thành công!", "success");
            return redirect()->route('addedServices');
        }
    }

    public function editAddedService(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'code'            => 'required',
            'name'            => 'required',
            'vehicle_type_id' => 'required|integer',
            'freight'         => 'required'
        ]);
        if ($validator->fails()) {
            flash_message("Thêm dịch vụ không thành công!", "danger");
            return back()->withErrors($validator)->withInput();
        } else {
            $added_service = AddedService::find($id);
            if (empty($added_service)) {
                return back()->withErrors(["Không tồn tại dịch vụ"])->withInput();
            } else {
                $added_service_tmp = AddedService::where("id", "<>", $id)->where("code", $request->code)->first();
                if (empty($added_service_tmp)) {
                    $added_service->code = $request->code;
                    $added_service->name = $request->name;
                    $added_service->vehicle_type_id = $request->vehicle_type_id;
                    $added_service->freight = $request->freight;
                    $added_service->save();
                    flash_message("Sửa dịch vụ thành công!", "success");
                    return redirect()->route('addedServices');
                } else {
                    return back()->withErrors(["Mã dịch vụ đã tồn tại"])->withInput();
                }
            }
        }
    }

    public function deleteAddedService($id){
        $user = Auth::user();
        if($user->isAdmin()){
            $added_service = AddedService::find($id);
            if(empty($added_service)){
                return 0;
            }else {
                $added_service->delete();
                return 1;
            }
        }else {
            return 0;
        }
    }

    public function deleteVehicleType($id){
        $user = Auth::user();
        if($user->isAdmin()){
            $vehicleType = VehicleType::find($id);
            if(empty($vehicleType)){
                return 0;
            }else {
                $vehicleType->delete();
                return 1;
            }
        }else {
            return 0;
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
