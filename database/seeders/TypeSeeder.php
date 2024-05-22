<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type::insert([
            "name"=>"BMI",
        ]);
        Type::insert([
            "name"=>"Magistrlik dissertatsiyasi",
        ]);
        Type::insert([
            "name"=>"Individual loyiha 1",
        ]);
        Type::insert([
            "name"=>"Individual loyiha 2",
        ]);
    }
}
