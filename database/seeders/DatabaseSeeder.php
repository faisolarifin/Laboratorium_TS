<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Mhs_Seeder::class);
        $this->call(Periode_Seed::class);
        $this->call(MatkulPraktikum_Seed::class);
    }
}
