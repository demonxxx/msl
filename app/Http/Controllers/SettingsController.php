<?php

namespace App\Http\Controllers;

use App\Shipper;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\VehicleType;
use App\AddedService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\OrderType;
use App\ShipperType;
use App\ShopScope;
use App\ShopType;
use App\Adminnistrative_units;

class SettingsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    public function showVehicleTypes() {
        $vehicle_types = VehicleType::all();
        return view('app.settings.vehicle_types', ['vehicle_types' => $vehicle_types]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    public function createVehicleType(Request $request) {
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

    public function editVehicleType(Request $request, $id) {
        $validator = \Validator::make($request->all(), [
                    'code' => 'required',
                    'name' => 'required',
        ]);
        if ($validator->fails()) {
            flash_message("Sửa phương tiện không thành công!", "danger");
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

    public function showAddedServices() {
        $added_services = DB::table('added_services')
                        ->join('vehicle_types', 'added_services.vehicle_type_id', '=', 'vehicle_types.id')
                        ->where('added_services.deleted_at')
                        ->where('vehicle_types.deleted_at')
                        ->select('added_services.*', 'vehicle_types.name as vehicle_name')->get();

        $vehicle_types = VehicleType::all();
        return view('app.settings.added_service', ['added_services' => $added_services, 'vehicle_types' => $vehicle_types]);
    }

    public function createAddedService(Request $request) {
        $validator = \Validator::make($request->all(), [
                    'code' => 'required|unique:added_services',
                    'name' => 'required',
                    'vehicle_type_id' => 'required|integer',
                    'freight' => 'required'
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

    public function editAddedService(Request $request, $id) {
        $validator = \Validator::make($request->all(), [
                    'code' => 'required',
                    'name' => 'required',
                    'vehicle_type_id' => 'required|integer',
                    'freight' => 'required'
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

    public function deleteAddedService($id) {
        $user = Auth::user();
        if ($user->isAdmin()) {
            $added_service = AddedService::find($id);
            if (empty($added_service)) {
                return 0;
            } else {
                $added_service->delete();
                return 1;
            }
        } else {
            return 0;
        }
    }

    public function deleteVehicleType($id) {
        $user = Auth::user();
        if ($user->isAdmin()) {
            $vehicleType = VehicleType::find($id);
            if (empty($vehicleType)) {
                return 0;
            } else {
                $vehicleType->delete();
                return 1;
            }
        } else {
            return 0;
        }
    }

    public function showShopTypes() {
        $shopTypes = ShopType::all();
        return view('app.settings.shop_types', ['shop_types' => $shopTypes]);
    }

    public function createShopType(Request $request) {
        $validator = \Validator::make($request->all(), [
                    'name' => 'required',
        ]);
        if ($validator->fails()) {
            flash_message("Thêm loại khách hàng không thành công!", "danger");
            return back()->withErrors($validator)->withInput();
        } else {
            $shopType = new ShopType;
            $shopType->name = $request->name;
            $shopType->save();
            flash_message("Thêm loại khách hàng thành công!", "success");
            return redirect()->route('shopTypes');
        }
    }

    public function editShopType(Request $request, $id) {
        $validator = \Validator::make($request->all(), [
                    'name' => 'required',
        ]);
        if ($validator->fails()) {
            flash_message("Sửa loại khách hàng không thành công!", "danger");
            return back()->withErrors($validator)->withInput();
        } else {
            $shopType = ShopType::find($id);
            if (empty($shopType)) {
                return back()->withErrors(["Không tồn loại khách hàng"])->withInput();
            } else {

                $shopType->name = $request->name;
                $shopType->save();
                flash_message("Sửa mã khách hàng thành công!", "success");
                return redirect()->route('shopTypes');
            }
        }
    }

    public function deleteShopType($id) {
        $user = Auth::user();
        if ($user->isAdmin()) {
            $shopType = ShopType::find($id);
            if (empty($shopType)) {
                return 0;
            } else {
                $shopType->delete();
                return 1;
            }
        } else {
            return 0;
        }
    }

    public function showShopScopes() {
        $shopScopes = ShopScope::all();
        return view('app.settings.shop_scopes', ['shop_scopes' => $shopScopes]);
    }

    public function createShopScope(Request $request) {
        $validator = \Validator::make($request->all(), [
                    'name' => 'required',
        ]);
        if ($validator->fails()) {
            flash_message("Thêm phạm vi shop không thành công!", "danger");
            return back()->withErrors($validator)->withInput();
        } else {
            $shopScope = new ShopScope;
            $shopScope->name = $request->name;
            $shopScope->save();
            flash_message("Thêm phạm vi shop thành công!", "success");
            return redirect()->route('shopScopes');
        }
    }

    public function editShopScope(Request $request, $id) {
        $validator = \Validator::make($request->all(), [
                    'name' => 'required',
        ]);
        if ($validator->fails()) {
            flash_message("Sửa phạm vi shop không thành công!", "danger");
            return back()->withErrors($validator)->withInput();
        } else {
            $shopScope = ShopScope::find($id);
            if (empty($shopScope)) {
                return back()->withErrors(["Không tồn phạm vi shop"])->withInput();
            } else {
                $shopScope->name = $request->name;
                $shopScope->save();
                flash_message("Sửa phạm vi shop thành công!", "success");
                return redirect()->route('shopScopes');
            }
        }
    }

    public function deleteShopScope($id) {
        $user = Auth::user();
        if ($user->isAdmin()) {
            $shopScope = ShopScope::find($id);
            if (empty($shopScope)) {
                return 0;
            } else {
                $shopScope->delete();
                return 1;
            }
        } else {
            return 0;
        }
    }

    public function showShipperTypes() {
        $shipperTypes = ShipperType::all();
        return view('app.settings.shipper_types', ['shipper_types' => $shipperTypes]);
    }

    public function createShipperType(Request $request) {
        $validator = \Validator::make($request->all(), [
                    'name' => 'required',
        ]);
        if ($validator->fails()) {
            flash_message("Thêm loại tài xế không thành công!", "danger");
            return back()->withErrors($validator)->withInput();
        } else {
            $shipperType = new ShipperType;
            $shipperType->name = $request->name;
            $shipperType->save();
            flash_message("Thêm loại tài xế thành công!", "success");
            return redirect()->route('shipperTypes');
        }
    }

    public function editShipperType(Request $request, $id) {
        $validator = \Validator::make($request->all(), [
                    'name' => 'required',
        ]);
        if ($validator->fails()) {
            flash_message("Sửa loại tài xế không thành công!", "danger");
            return back()->withErrors($validator)->withInput();
        } else {
            $shipperType = ShipperType::find($id);
            if (empty($shipperType)) {
                return back()->withErrors(["Không tồn loại tài xế"])->withInput();
            } else {

                $shipperType->name = $request->name;
                $shipperType->save();
                flash_message("Sửa loại tài xế thành công!", "success");
                return redirect()->route('shipperTypes');
            }
        }
    }

    public function deleteShipperType($id) {
        $user = Auth::user();
        if ($user->isAdmin()) {
            $shipperType = ShipperType::find($id);
            if (empty($shipperType)) {
                return 0;
            } else {
                $shipperType->delete();
                return 1;
            }
        } else {
            return 0;
        }
    }

    public function showOrderTypes() {
        $orderTypes = OrderType::all();
        return view('app.settings.order_types', ['order_types' => $orderTypes]);
    }

    public function createOrderType(Request $request) {
//        dd("create order type");
        $validator = \Validator::make($request->all(), [
                    'name' => 'required',
                    'freight' => 'required|integer'
        ]);
        if ($validator->fails()) {
            flash_message("Thêm loại đơn hàng không thành công!", "danger");
            return back()->withErrors($validator)->withInput();
        } else {
            $orderType = new OrderType;
            $orderType->name = $request->name;
            $orderType->freight = $request->freight;
            $orderType->save();
            flash_message("Thêm loại đơn hàng thành công!", "success");
            return redirect()->route('orderTypes');
        }
    }

    public function editOrderType(Request $request, $id) {
        $validator = \Validator::make($request->all(), [
                    'name' => 'required',
                    'freight' => 'required|integer'
        ]);
        if ($validator->fails()) {
            flash_message("Sửa loại đơn hàng không thành công!", "danger");
            return back()->withErrors($validator)->withInput();
        } else {
            $orderType = OrderType::find($id);
            if (empty($orderType)) {
                return back()->withErrors(["Không tồn loại đơn hàng"])->withInput();
            } else {

                $orderType->name = $request->name;
                $orderType->freight = $request->freight;
                $orderType->save();
                flash_message("Sửa loại đơn hàng thành công!", "success");
                return redirect()->route('orderTypes');
            }
        }
    }

    public function deleteOrderType($id) {
        $user = Auth::user();
        if ($user->isAdmin()) {
            $orderType = OrderType::find($id);
            if (empty($orderType)) {
                return 0;
            } else {
                $orderType->delete();
                return 1;
            }
        } else {
            return 0;
        }
    }

    public function show_administrative_units() {
        $admin_unit = new Adminnistrative_units();
        $unit_list = $admin_unit->get_all();
        $cities = $admin_unit->get_city();

        foreach ($cities as $key => $city) {
            $cities[$key]->districts = [];
            $districts = $admin_unit->get_district($city->id);
            if (!empty($districts)) {
                foreach ($districts as $key_1 => $district) {
                    $districts[$key_1]->wards = $admin_unit->get_ward($district->id);
                }
            }
            $cities[$key]->districts = $districts;
        }
        return view('app.settings.administrative_units', ['cities' => $cities]);
    }

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
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

}
