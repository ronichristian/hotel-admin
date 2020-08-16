<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $adminRole = Role::where('name', 'superadmin')->first();
        $bangquetRole = Role::where('name', 'bangquet')->first();

        $admin = User::create([
            'name' => 'Roni Christian Puno',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('qweqwe123')
        ]);

        $user = User::create([
            'name' => 'Bangquet User',
            'email' => 'puno.roni@gmail.com',
            'password' => bcrypt('qweqwe123')
        ]);

        $admin->roles()->attach($adminRole);
        $user->roles()->attach($bangquetRole);
    }
}
