<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\AkunMhs;
use App\Models\Dosen;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class Mhs_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i < 50; $i++) {
            AkunMhs::create([
                        'nama' => fake()->name(),
                        'nim' => rand(11111111,99999999),
                        'password' => 'faisol',
                        'alamat' => fake()->address(),
                        'tmp_lahir' => fake()->city(),
                        'tgl_lahir' => fake()->date(),
                        'no_hp' => fake()->phoneNumber(),
                        'email' => fake()->unique()->safeEmail(),
                        'foto' => 'public/foto/default.png',
                        'status' => 'non-aktif',
                    ]);

        }
        for($i=0; $i < 15; $i++) {
            Dosen::create([
                'nip' => rand(111111111,999999999),
                'nama' => 'Dr. '.fake()->name(),
                'jabatan' => fake()->jobTitle(),
                'alamat' => fake()->address(),
                'no_hp' => fake()->phoneNumber(),
                'email' => fake()->safeEmail(),
            ]);
        }

        Admin::create([
            'nama' => 'Faisol, S.Kom.,M.Cs.',
            'username' => 'admin',
            'password' => 'admin',
        ]);

        $dataSetting = [
            [
                'key' => 'dekan',
                'value' => 'CHOLILUL CHAYATI, MT.',
            ],
            [
                'key' => 'periode_aktif',
                'value' => '1',
            ],
            [
                'key' => 'kalab',
                'value' => 'ACH. DESMANTRI RAHMANTO, MT.',
            ],
            [
                'key' => 'praktikum',
                'value' => 'off',
            ],
        ];
        foreach ($dataSetting as $row) {
            Setting::create($row);
        }
    }
}
