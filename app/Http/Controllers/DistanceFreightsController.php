<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Helpers\helpers;
use App\Distance_freights;
use App\Vehicle_types;

class DistanceFreightsController extends Controller {

    protected $distance_freights;

    function __construct() {
        $this->distance_freights = new Distance_freights();
    }

    public function index() {
        return view('app.distance_freights.index', ['main_list' => $this->distance_freights->get_all()]);
    }

    public function create() {
        $max_id = Distance_freights::max('id');
        $dist_freight_code = $max_id + 1;
        $vehicle_list = Vehicle_types::get();
        return view('app.distance_freights.create', ['dist_freight_code' => $dist_freight_code, 'vehicle_list' => $vehicle_list]);
    }

    public function store(Request $request) {
        $validator = \Validator::make($request->all(), [
                    'code' => 'required|max:15|unique:distance_freights',
                    'name' => 'required|max:255|unique:distance_freights',
                    'from' => 'required|integer',
                    'to' => 'required|integer',
                    'freight' => 'required|integer',
                    'vehicle_type_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            flash_message("Tạo đơn giá mới không thành công", "danger");
            return redirect('distance_freights/create')->withErrors($validator)->withInput();
        } else {
            $dist_freight = $this->distance_freights;
            $check_code = $dist_freight->where('code', $request->code)->first();
            if (!empty($check_code)) {
                return redirect('distance_freights/create')->withErrors(['Mã đơn giá đã tồn tại!'])->withInput();
            }
            $dist_freight->code = $request->code;
            $dist_freight->name = $request->name;
            $dist_freight->from = $request->from;
            $dist_freight->to = $request->to;
            $dist_freight->freight = $request->freight;
            $dist_freight->vehicle_type_id = $request->vehicle_type_id;
            $dist_freight->save();
            flash_message("Tạo tài xế mới thành công!");
            return back();
        }
    }

    public function edit($dist_freight_id) {
        $dist_freight = $this->distance_freights;
        $dist_freight_obj = $dist_freight->find($dist_freight_id);
        $vehicle_list = Vehicle_types::get();
        return view("app.distance_freights.edit", ["dist_freight" => $dist_freight_obj, "dist_freight_id" => $dist_freight_id, 'vehicle_list' => $vehicle_list]);
    }

    public function update(Request $request, $dist_freight_id) {
        $validator = \Validator::make($request->all(), [
                    'code' => 'required|max:15',
                    'name' => 'required|max:255',
                    'from' => 'required|integer',
                    'to' => 'required|integer',
                    'freight' => 'required|integer',
                    'vehicle_type_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            flash_message("Cập nhật đơn giá không thành công!", "danger");
            return redirect("distance_freights/{$dist_freight_id}/edit")->withErrors($validator)->withInput();
        } else {
            $dist_freight = $this->distance_freights;
            $check_code = $dist_freight
                    ->where('code', "=", $request->code)
                    ->where('id', '!=', $dist_freight_id)
                    ->first();
            $errors = [];
            if (!empty($check_code)) {
                array_push($errors, "Mã đơn giá đã tồn tại");
            }
            $check_name = $dist_freight
                    ->where('name', "=", $request->name)
                    ->where('id', '!=', $dist_freight_id)
                    ->first();
            if (!empty($check_name)) {
                array_push($errors, "Tên đơn giá đã tồn tại");
            }
            if (!empty($errors)) {
                return redirect("distance_freights/{$dist_freight_id}/edit")->withErrors($errors)->withInput();
            } else {
                $dist_freight_obj = $this->distance_freights->find($dist_freight_id);
                $dist_freight_obj->name = $request->name;
                $dist_freight_obj->code = $request->code;
                $dist_freight_obj->from = $request->from;
                $dist_freight_obj->to = $request->to;
                $dist_freight_obj->freight = $request->freight;
                $dist_freight_obj->vehicle_type_id = $request->vehicle_type_id;
                if ($dist_freight_obj->save()) {
                    flash_message("Cập nhật đơn giá thành công");
                } else {
                    flash_message("Cập nhật đơn giá không thành công", "danger");
                }
                return redirect("distance_freights");
            }
        }
    }

    public function destroy($dist_freight_id) {
        if ($this->distance_freights->destroy($dist_freight_id)) {
            flash_message("Xóa đơn giá thành công");
        } else {
            flash_message("Xóa đơn giá không thành công", "danger");
        }
        return redirect("distance_freights");
    }

}
