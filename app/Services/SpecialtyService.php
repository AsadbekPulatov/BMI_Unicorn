<?php

namespace App\Services;

use App\Models\Plan;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class SpecialtyService
{
    public static function getSpecialtyForHemis($page = 1)
    {
//        TODO: O'qituvchilarni yo'nalishlarni olish
        $client = new Client(['verify' => false]);
        $params = "limit=200&page={$page}";
        $url = "https://student.ubtuit.uz/rest/v1/data/specialty-list";
        $headers = [
            'Authorization' => 'Bearer ' . env('EMPLOYEE_TOKEN'),
        ];
        $request = new Request('GET', "{$url}?{$params}", $headers);
        $res = $client->sendAsync($request)->wait();
        $response = json_decode($res->getBody());
        session()->put('specialty', $response);
    }

    public static function getSpecialty()
    {
//        TODO: Yo'nalishlarni fakultetlar bo'yicha joylashtirish
        $Specialty = session('specialty');
        if (!isset($Specialty)) {
            self::getSpecialtyForHemis();
            $Specialty = session('specialty');
        }
        if ($Specialty->code == 200) {
            $Specialty = $Specialty->data->items;
            $data = [];
            foreach ($Specialty as $item) {
                $data[$item->department->id][] = $item;
            }
        }
        return $data;
    }

    public static function getSpecialtyForDepartment($arr){
        $specialty = SpecialtyService::getSpecialty();
        $result = [];
        foreach ($specialty as $key => $value) {
            if (in_array($key, $arr))
            if (is_array($value)) {
                $result = array_merge($result, $value);
            } else {
                $result[] = $value;
            }
        }
        return $result;
    }

    public static function getSpecialtyForId($id)
    {
        $Specialty = session('specialty');
        if (!isset($Specialty)) {
            self::getSpecialtyForHemis();
            $Specialty = session('specialty');
        }
        if ($Specialty->code == 200) {
            $Specialty = $Specialty->data->items;
            $data = [];
            foreach ($Specialty as $item) {
                $data[$item->code] = $item;
            }
        }
        return $data[$id] ?? null;
    }
}