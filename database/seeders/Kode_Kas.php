<?php

namespace Database\Seeders;

use App\Models\Keuangan\KodeKas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Kode_Kas extends Seeder
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
                'nm_kode' => 'P',
                'harga' => '55000',
                'ket' => 'Uji Paving',
            ],
            [
                'nm_kode' => 'S',
                'harga' => '55000',
                'ket' => 'Uji Beton Silinder',
            ],
            [
                'nm_kode' => 'K',
                'harga' => '55000',
                'ket' => 'Uji Beton Kubus',
            ],
            [
                'nm_kode' => 'TB',
                'harga' => '140000',
                'ket' => 'Pendaftaran Praktikum Teknologi Bahan',
            ],
            [
                'nm_kode' => 'IU',
                'harga' => '70000',
                'ket' => 'Pendaftaran Praktikum Ilmu Ukur Tanah',
            ],
            [
                'nm_kode' => 'PT',
                'harga' => '80000',
                'ket' => 'Pendaftaran Praktikum Perpetaan',
            ],
            [
                'nm_kode' => 'HD',
                'harga' => '60000',
                'ket' => 'Pendaftaran Praktikum Hidrolika',
            ],
            [
                'nm_kode' => 'JL',
                'harga' => '160000',
                'ket' => 'Pendaftaran Praktikum Jalan',
            ],
            [
                'nm_kode' => 'MT',
                'harga' => '60000',
                'ket' => 'Pendaftaran Praktikum Mekanika Tanah',
            ],
            [
                'nm_kode' => 'BT',
                'harga' => '125000',
                'ket' => 'Pendaftaran Praktikum Beton',
            ],
            [
                'nm_kode' => 'PE',
                'harga' => '0',
                'ket' => 'Pengeluaran',
            ],
            [
                'nm_kode' => 'IN',
                'harga' => '0',
                'ket' => 'Pendapatan',
            ],
        ];

        foreach($data as $row) {
            KodeKas::create($row);
        }
    }
}
