<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\mapel;
use App\Models\kelas;
use App\Models\jurusan;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role = [
            ['name' => 'admin', 'guard_name' => 'web'],
            ['name' => 'guru', 'guard_name' => 'web'],
            ['name' => 'siswa', 'guard_name' => 'web'],
        ];

        Role::insert($role);

        $user = User::create([
            'name' => 'zamzam',
            'email' => 'zamisyh@gmail.com',
            'password' => bcrypt('zamzam'),
        ]);

        $user->assignRole('admin');


        $jurusan = [
            ['nama' => 'Rekayasa Perangkat Lunak', 'alias' => 'RPL'],
            ['nama' => 'Perbankan Syariah', 'alias' => 'PBS'],
            ['nama' => 'Perbankan', 'alias' => 'PB'],
            ['nama' => 'Kimia Analis', 'alias' => 'KA'],
            ['nama' => 'Teknik Elektronika Industri', 'alias' => 'TEI'],
        ];

        $mapel = [
            ['nama' => 'Matematika'],
            ['nama' => 'Pendidikan Agama Islam'],
            ['nama' => 'Bahasa Inggris'],
            ['nama' => 'Bahasa Indonesia'],
        ];

        mapel::insert($mapel);
        jurusan::insert($jurusan);
    }
}
