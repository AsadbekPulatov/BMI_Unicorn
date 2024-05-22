<?php

namespace Database\Seeders;

use App\Models\Kafedra;
use App\Services\KafedraService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KafedraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = KafedraService::getKefedraforHemis();
        foreach ($departments as $name => $id){
            Kafedra::insert([
                'name' => $name,
                'id' => $id
            ]);
        }
    }
}
