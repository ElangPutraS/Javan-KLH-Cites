<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['role_name' => 'Administrator']);
        Role::create(['role_name' => 'Pelaku Usaha']);
        Role::create(['role_name' => 'Super Admin']);
    }
}
