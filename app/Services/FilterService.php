<?php

namespace App\Services;


use Illuminate\Support\Facades\DB;

class FilterService
{
    public static function filter($table, $options){
        $themes = $table::query();

        $search = $options['search'] ?? [];
        $order_by = $options['order_by'] ?? ["created_at" => "ASC"];
        $group_by = $options['group_by'] ?? null;
        $condition = $options['condition'] ?? null;
        $relations = $options['relations'] ?? null;
        $paginate = $options['paginate'] ?? null;


        if ($relations != null){
            foreach ($relations as $item)
                $themes = $themes->with($item);
        }

        foreach ($order_by as $col => $value){
            $themes = $themes->orderBy($col, $value);
        }

        if ($condition != null){
            foreach ($condition as $item){
                $themes = $themes->where($item['column'], $item['condition'], $item['value']);
            }
        }

        foreach ($search as $col => $value){
            if (is_array($value)){
                $themes = $themes->whereIn($col, $value);
            }else{
                if ($value != 0)
                $themes = $themes->where($col, $value);
            }
        }

        if ($paginate == null){
            $themes = $themes->get();
        }
        else {
            $themes = $themes->paginate($paginate);
        }

        if ($group_by != null){
            $themes = $themes->groupBy($group_by);
        }

        return $themes;
    }
}