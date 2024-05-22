<?php

namespace App\Services;

use App\Models\Kafedra;
use Illuminate\Http\Request;

class KafedraService
{
    public static function getKefedraforHemis(){
//        TODO: Kafedralarni HEMIS dan olish
        $employees = session('employees');
        if (!isset($employees)){
            EmployeeService::getEmployeeAll();
        }
        $employees = session('employees');
        $departments = [];
        foreach ($employees as $item){
            $departments[$item->department->name] = $item->department->id;
        }
        return $departments;
    }

    public static function getKafedraForMudir($id){
//        TODO: Mudirning kafedrasini aniqlash
        $employees = session('employees');
        if (!isset($employees)){
            EmployeeService::getEmployeeAll();
        }
        $employees = session('employees');
        $kafedras = [];
        foreach ($employees as $employee){
            if ($id == $employee->employee_id_number)
                $kafedras[] = $employee->department->id;
        }
        return $kafedras;
    }

    public static function index(){
        $kafedras = Kafedra::all();
        $data = [
            'data' => $kafedras,
            'code' => 200
        ];
        return $data;
    }

    public static function store(Request $request){
        $request->validate([
            'name' => 'required',
        ]);

        try {
            $kafedra = new Kafedra();
            $kafedra->name = $request->name;
            $kafedra->save();
            $data['code'] = 200;
            $data['message'] = "success";
            $data['data'] = $kafedra;
        } catch (\Exception $e) {
            $data['code'] = 400;
            $data['message'] = $e;
            $data['data'] = [];
        }
        return $data;
    }

    public static function show($id){
        $kafedra = Kafedra::find($id);
        if (isset($kafedra)){
            $data['code'] = 200;
            $data['message'] = "success";
            $data['data'] = $kafedra;
        }
        else {
            $data['code'] = 400;
            $data['message'] = "error";
            $data['data'] = [];
        }
        return $data;
    }

    public static function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
        ]);

        try {
            $kafedra = Kafedra::find($id);
            if (isset($kafedra)){
                $kafedra->name = $request->name;
                $kafedra->save();
                $data['code'] = 200;
                $data['message'] = "success";
                $data['data'] = $kafedra;
            }
            else{
                $data['code'] = 400;
                $data['message'] = "error";
                $data['data'] = [];
            }

        } catch (\Exception $e) {
            $data['code'] = 400;
            $data['message'] = $e;
            $data['data'] = [];
        }
        return $data;
    }

    public static function delete($id){
        $kafedra = Kafedra::find($id);
        if (isset($kafedra)){
            $kafedra->delete();
            $data['code'] = 200;
            $data['message'] = "success";
            $data['data'] = $kafedra;
        }
        else {
            $data['code'] = 400;
            $data['message'] = "error";
            $data['data'] = [];
        }
        return $data;
    }
}