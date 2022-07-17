<?php

namespace Database\Seeders;

use App\Models\{Periode, MatkulPraktikum, PendaftarAcc};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Periode_Seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $add = Periode::create([
            'thn_ajaran' => '2021/2022',
            'semester' => 'Genap',
        ]);
        foreach(MatkulPraktikum::all() as $row){
            if (PendaftarAcc::where([
                'id_mp' => $row->id_mp,
                'id_periode' => $add->id_periode,
                ])->first() == null)
            {
                PendaftarAcc::create([
                    'id_mp' => $row->id_mp,
                    'id_periode' => $add->id_periode,
                ]);
            }
        }
    }
}
