<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class GroupService
{
    public static function getGroupsForHemis($page = 1)
    {
//        TODO: O'qituvchilarni yo'nalishlarni olish
        $client = new Client(['verify' => false]);
        $params = "limit=200&page={$page}";
        $url = "https://student.ubtuit.uz/rest/v1/data/group-list";
        $headers = [
            'Authorization' => 'Bearer ' . env('EMPLOYEE_TOKEN'),
        ];
        $request = new Request('GET', "{$url}?{$params}", $headers);
        $res = $client->sendAsync($request)->wait();
        $response = json_decode($res->getBody());
        session()->put('groups', $response);
    }

    public static function getGroups()
    {
//        TODO: Yo'nalishlarni fakultetlar bo'yicha joylashtirish
        $Specialty = session('groups');
        if (!isset($Specialty)) {
            self::getGroupsForHemis();
            $Specialty = session('groups');
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
}