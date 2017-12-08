<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => bcrypt('asdf1234'),
        ]);



        $role = Role::find(1);
        $user->roles()->attach($role);

        $user1 = User::create([
        'name' => 'Super Admin',
        'email' => 'superadmin@example.com',
        'password' => bcrypt('1234asdf'),
    ]);

        $role = Role::find(3);
        $user1->roles()->attach($role);
    }
}
