<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\UserProfile;
use App\City;
use App\Company;
use App\TypeIdentify;

class UserCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //User 1
        $user = User::create([
            'name' => 'User Example 1',
            'email' => 'user1@example.com',
            'password' => bcrypt('user1@example.com'),
        ]);

        $role = Role::find(2);
        $user->roles()->attach($role);

        $user_profile=UserProfile::create([
            'place_of_birth' => 'Bandung',
            'date_of_birth' => '1996-06-08',
            'address' => 'Jln. Nata Kusumah II',
            'mobile' => '082240206478',
            'created_by' => $user->id,
            'npwp_number' => '12345678911',
            'city_id' => '21',
            'province_id' => '32',
            'country_id' => '1',
        ]);
        $user->userProfile()->save($user_profile);

        $type_identity=TypeIdentify::find(1);
        $user_profile->typeIdentify()->attach($type_identity, ['user_type_identify_number'=>'123456789101234']);

        $company=Company::create([
            'company_name' => 'Javan',
            'company_address' => 'Komp. Daichi No 55',
            'company_email' => 'javan@gmail.com',
            'company_fax' => '5430987',
            'company_latitude' => '-6.90889',
            'company_longitude' => '107.65177',
            'owner_name' => 'Bapak A',
            'captivity_address' => 'Jln. Ir. H.  Juanda',
            'labor_total' => 50,
            'investation_total' => 100000000,
            'npwp_number' => '12345678910',
            'date_distribution' => '2018-06-06',
            'city_id' => '21',
            'province_id' => '32',
            'country_id' => '1',
            'created_by' => $user->id,
            'user_id' => $user->id
        ]);
        $user_profile->company()->save($company);

        //User 2
        $user = User::create([
            'name' => 'User Example 2',
            'email' => 'user2@example.com',
            'password' => bcrypt('user2@example.com'),
        ]);

        $role = Role::find(2);
        $user->roles()->attach($role);

        $user_profile=UserProfile::create([
            'place_of_birth' => 'Jakarta',
            'date_of_birth' => '1996-12-08',
            'address' => 'Jln. Nata Kusumah III',
            'mobile' => '085547845122',
            'created_by' => $user->id,
            'npwp_number' => '12345678910',
            'city_id' => '21',
            'province_id' => '31',
            'country_id' => '1',
        ]);
        $user->userProfile()->save($user_profile);

        $type_identity=TypeIdentify::find(1);
        $user_profile->typeIdentify()->attach($type_identity, ['user_type_identify_number'=>'432156789101234']);

        $company=Company::create([
            'company_name' => 'PT Jaya Abadi',
            'company_email' => 'jayaabadi@gmail.com',
            'company_address' => 'Jln. Jakarta',
            'company_fax' => '5372181',
            'company_latitude' => '-6.175392',
            'company_longitude' => '106.827153',
            'owner_name' => 'Bapak B',
            'captivity_address' => 'Jln. Ir. H.  Juanda',
            'labor_total' => 50,
            'investation_total' => 100000000,
            'npwp_number' => '12345678910',
            'date_distribution' => '2018-06-06',
            'city_id' => '21',
            'province_id' => '31',
            'country_id' => '1',
            'created_by' => $user->id,
            'user_id' => $user->id
        ]);
        $user_profile->company()->save($company);

        //User 3
        $user = User::create([
            'name' => 'User Example 3',
            'email' => 'user3@example.com',
            'password' => bcrypt('user3@example.com'),
        ]);

        $role = Role::find(2);
        $user->roles()->attach($role);

        $user_profile=UserProfile::create([
            'place_of_birth' => 'Bandung',
            'date_of_birth' => '1996-12-30',
            'address' => 'Jln. Nata Kusumah I',
            'mobile' => '089547845122',
            'created_by' => $user->id,
            'npwp_number' => '12345678912',
            'city_id' => '21',
            'province_id' => '32',
            'country_id' => '1',
        ]);
        $user->userProfile()->save($user_profile);

        $type_identity=TypeIdentify::find(1);
        $user_profile->typeIdentify()->attach($type_identity, ['user_type_identify_number'=>'456756789101234']);

        $company=Company::create([
            'company_name' => 'PT Bandung Sejahtera',
            'company_email' => 'bandungsejahtera@gmail.com',
            'company_address' => 'Jln. Antapani',
            'company_fax' => '6781234',
            'company_latitude' => '-6.918583',
            'company_longitude' => '107.660007',
            'owner_name' => 'Bapak C',
            'captivity_address' => 'Jln. Ir. H.  Juanda',
            'labor_total' => 50,
            'investation_total' => 100000000,
            'npwp_number' => '12345678910',
            'date_distribution' => '2018-06-06',
            'city_id' => '21',
            'province_id' => '32',
            'country_id' => '1',
            'created_by' => $user->id,
            'user_id' => $user->id
        ]);
        $user_profile->company()->save($company);
    }
}
