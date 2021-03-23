<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin'
        ]);

        $user = User::create([
            'name' => 'zamzam',
            'email' => 'zamisyh@gmail.com',
            'password' => bcrypt('zamzam'),
        ]);

        $user->assignRole('admin');
    }
}
