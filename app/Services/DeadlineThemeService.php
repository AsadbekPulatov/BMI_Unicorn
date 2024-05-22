<?php

namespace App\Services;

use App\Models\DeadlineTheme;
use App\Models\Type;
use Illuminate\Http\Request;

class DeadlineThemeService
{
    public static function index(){
        $deadline = DeadlineTheme::all();
        $types = Type::all();
        $data = [
            'deadline' => $deadline,
            'types' => $types,
        ];
        $data = [
            'data' => $data,
            'code' => 200
        ];
        return $data;
    }

    public static function store(Request $request){
        $now = Statistic::getThisYear();

        $values = $request->validate([
            'type_id' => 'required',
            'select_end_date' => 'required|date',
        ]);

        $count = DeadlineTheme::where('date', $now)->where('type_id', $values['type_id'])->count();
        if ($count > 0){
            $data['code'] = 400;
            $data['message'] = "Bu yil uchun muddat kiritilgan!";
            $data['data'] = [];
            return $data;
        }
        try {
            $deadline = new DeadlineTheme();
            $deadline->type_id = $values['type_id'];
            $deadline->date = $now;
            $deadline->select_end_date = $values['select_end_date'];
            $deadline->save();
            $data['code'] = 200;
            $data['message'] = "success";
            $data['data'] = $deadline;
        } catch (\Exception $e) {
            $data['code'] = 400;
            $data['message'] = $e;
            $data['data'] = [];
        }
        return $data;
    }

    public static function show($id){
        $deadline = DeadlineTheme::find($id);
        if (isset($deadline)){
            $data['code'] = 200;
            $data['message'] = "success";
            $data['data'] = $deadline;
        }
        else {
            $data['code'] = 400;
            $data['message'] = "error";
            $data['data'] = [];
        }
        return $data;
    }

    public static function update(Request $request, $id){
        $now = Statistic::getThisYear();

        $values = $request->validate([
            'type_id' => 'required',
            'select_end_date' => 'required|date',
        ]);

        $count = DeadlineTheme::where('id', '!=', $id)->where('date', $now)->where('type_id', $values['type_id'])->count();
        if ($count > 0){
            $data['code'] = 400;
            $data['message'] = "Bu yil uchun muddat kiritilgan!";
            $data['data'] = [];
            return $data;
        }

        try {
            $deadline = DeadlineTheme::find($id);
            if (isset($deadline)){
                $deadline->type_id = $values['type_id'];
                $deadline->date = $now;
                $deadline->select_end_date = $values['select_end_date'];
                $deadline->save();
                $data['code'] = 200;
                $data['message'] = "success";
                $data['data'] = $deadline;
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
        $deadline = DeadlineTheme::find($id);
        if (isset($deadline)){
            $deadline->delete();
            $data['code'] = 200;
            $data['message'] = "success";
            $data['data'] = $deadline;
        }
        else {
            $data['code'] = 400;
            $data['message'] = "error";
            $data['data'] = [];
        }
        return $data;
    }

    public static function deadline($type_id, $date){
        $deadline = DeadlineTheme::where('type_id', $type_id)->where('date', $date)->first();
        return $deadline->select_end_date ?? null;
    }
}