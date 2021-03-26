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
            ['name' => 'admin', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' =>  \Carbon\Carbon::now()],
            ['name' => 'guru', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' =>  \Carbon\Carbon::now()],
            ['name' => 'siswa', 'guard_name' => 'web', 'created_at' => \Carbon\Carbon::now(), 'updated_at' =>  \Carbon\Carbon::now()],
        ];

        Role::insert($role);

        $user = User::create([
            'name' => 'zamzam',
            'email' => 'zamisyh@gmail.com',
            'password' => bcrypt('zamzam'),
        ]);

        $user->assignRole('admin');


        $jurusan = [
            ['nama' => 'Rekayasa Perangkat Lunak', 'alias' => 'RPL', 'created_at' => \Carbon\Carbon::now(), 'updated_at' =>  \Carbon\Carbon::now()],
            ['nama' => 'Perbankan Syariah', 'alias' => 'PBS', 'created_at' => \Carbon\Carbon::now(), 'updated_at' =>  \Carbon\Carbon::now()],
            ['nama' => 'Perbankan', 'alias' => 'PB', 'created_at' => \Carbon\Carbon::now(), 'updated_at' =>  \Carbon\Carbon::now()],
            ['nama' => 'Kimia Analis', 'alias' => 'KA', 'created_at' => \Carbon\Carbon::now(), 'updated_at' =>  \Carbon\Carbon::now()],
            ['nama' => 'Teknik Elektronika Industri', 'alias' => 'TEI', 'created_at' => \Carbon\Carbon::now(), 'updated_at' =>  \Carbon\Carbon::now()],
        ];

        $mapel = [
            ['nama' => 'Matematika', 'created_at' => \Carbon\Carbon::now(), 'updated_at' =>  \Carbon\Carbon::now()],
            ['nama' => 'Pendidikan Agama Islam', 'created_at' => \Carbon\Carbon::now(), 'updated_at' =>  \Carbon\Carbon::now()],
            ['nama' => 'Bahasa Inggris', 'created_at' => \Carbon\Carbon::now(), 'updated_at' =>  \Carbon\Carbon::now()],
            ['nama' => 'Bahasa Indonesia', 'created_at' => \Carbon\Carbon::now(), 'updated_at' =>  \Carbon\Carbon::now()],
        ];

        mapel::insert($mapel);
        jurusan::insert($jurusan);
    }
}
