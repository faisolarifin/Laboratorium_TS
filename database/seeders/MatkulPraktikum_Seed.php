<?php

namespace Database\Seeders;

use App\Models\Praktikum\MatkulPraktikum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



class MatkulPraktikum_Seed extends Seeder
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
                'nama_mp' => 'Teknologi Bahan',
                'harga' => 140000,
                'deskripsi' => '',
            ],
            [
                'nama_mp' => 'Ilmu Ukur Tanah',
                'harga' => 70000,
                'deskripsi' => '',
            ],
            [
                'nama_mp' => 'Perpetaan',
                'harga' => 80000,
                'deskripsi' => '',
            ],
            [
                'nama_mp' => 'Hidorolika',
                'harga' => 60000,
                'deskripsi' => '',
            ],
            [
                'nama_mp' => 'Perkerasan Jalan Raya',
                'harga' => 160000,
                'deskripsi' => '',
            ],
            [
                'nama_mp' => 'Mekanika Tanah',
                'harga' => 60000,
                'deskripsi' => '',
            ],
            [
                'nama_mp' => 'Beton',
                'harga' => 125000,
                'deskripsi' => '',
            ],
        ];
        foreach($data as $list){
            MatkulPraktikum::create($list);
        }

    }
}
