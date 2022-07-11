<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\AkunMhs;
use App\Models\Dosen;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Faker\Factory;

class Mhs_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');
        for($i=0; $i < 50; $i++) {
            AkunMhs::create([
                        'nama' => $faker->name(),
                        'nim' => rand(11111111,99999999),
                        'password' => 'faisol',
                        'alamat' => $faker->address(),
                        'tmp_lahir' => $faker->city(),
                        'tgl_lahir' => $faker->date(),
                        'no_hp' => $faker->phoneNumber(),
                        'email' => $faker->unique()->safeEmail(),
                        'foto' => 'public/foto/default.png',
                        'status' => 'non-aktif',
                    ]);

        }
        for($i=0; $i < 15; $i++) {
            Dosen::create([
                'nip' => rand(111111111,999999999),
                'nama' => 'Dr. '.$faker->name(),
                'jabatan' => $faker->jobTitle(),
                'alamat' => $faker->address(),
                'no_hp' => $faker->phoneNumber(),
                'email' => $faker->safeEmail(),
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
        ];
        foreach ($dataSetting as $row) {
            Setting::create($row);
        }
    }
}
