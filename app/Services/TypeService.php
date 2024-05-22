<?php

namespace App\Services;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeService
{
    public static function index(){
        $types = Type::all();
        $data = [
            'data' => $types,
            'code' => 200
        ];
        return $data;
    }

    public static function store(Request $request){
        $request->validate([
            'name' => 'required',
        ]);

        try {
            $type = new Type();
            $type->name = $request->name;
            $type->save();
            $data['code'] = 200;
            $data['message'] = "success";
            $data['data'] = $type;
        } catch (\Exception $e) {
            $data['code'] = 400;
            $data['message'] = $e;
            $data['data'] = [];
        }
        return $data;
    }

    public static function show($id){
        $type = Type::find($id);
        if (isset($type)){
            $data['code'] = 200;
            $data['message'] = "success";
            $data['data'] = $type;
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
            $type = Type::find($id);
            if (isset($type)){
                $type->name = $request->name;
                $type->save();
                $data['code'] = 200;
                $data['message'] = "success";
                $data['data'] = $type;
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
        $type = Type::find($id);
        if (isset($type)){
            $type->delete();
            $data['code'] = 200;
            $data['message'] = "success";
            $data['data'] = $type;
        }
        else {
            $data['code'] = 400;
            $data['message'] = "error";
            $data['data'] = [];
        }
        return $data;
    }
}