<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class Mhs_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama' => "ACH. DESMANTRI RAHMANTO, MT.",
            'username' => "admin",
            'password' => Hash::make('admin'),
            'alamat' => "Jl. Udang",
            'tmp_lahir' => "",
            'tgl_lahir' => null,
            'no_hp' => "",
            'email' => "admin@gmail.com",
            'foto' => 'public/foto/desmantri.jpg',
            'status' => 'aktif',
            'role' => 'admin',
        ]);

        $faker = Factory::create('id_ID');
         for($i=0; $i < 30; $i++) {
             User::create([
                         'nama' => $faker->name(),
                         'username' => rand(11111111,99999999),
                         'password' => Hash::make('faisol'),
                         'alamat' => $faker->address(),
                         'tmp_lahir' => $faker->city(),
                         'tgl_lahir' => $faker->date(),
                         'no_hp' => $faker->phoneNumber(),
                         'email' => $faker->unique()->safeEmail(),
                         'foto' => 'public/foto/default.png',
                         'status' => 'non-aktif',
                         'role' => 'mahasiswa',
                     ]);

         }
        for($i=0; $i < 15; $i++) {
            Dosen::create([
                'nidn' => rand(111111111,999999999),
                'nama' => 'Dr. '.$faker->name(),
                'jabatan' => $faker->jobTitle(),
                'alamat' => $faker->address(),
                'no_hp' => $faker->phoneNumber(),
                'email' => $faker->safeEmail(),
            ]);
        }

        Setting::create([
            'dekan' => 'CHOLILUL CHAYATI, MT.',
            'kaprodi' => 'Faisol S.Kom,M.Cs.',
            'kalab' => 'ACH. DESMANTRI RAHMANTO, MT.',
            'periode_aktif' => '1',
            'praktikum' => 'off',
        ]);
    }
}
