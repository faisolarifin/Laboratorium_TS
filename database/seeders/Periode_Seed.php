<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Periode;

class Periode_Seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
             'thn_ajaran' => '2021/2022',
             'semester' => 'Genap'   
            ]
        ];
        foreach ($data as $list){
            Periode::create($list);
        }
    }
}
