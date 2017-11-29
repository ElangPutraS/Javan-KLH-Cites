<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(RolesSeeder::class);
         $this->call(UsersSeeder::class);
         $this->call(LaraciproidSeeder::class);
         $this->call(DocumentTypeSeeder::class);
         $this->call(TypeIdentifySeeder::class);
         $this->call(UserCompanySeeder::class);
         $this->call(MasterSpeciesSeeder::class);
         $this->call(PortsSeeder::class);
         $this->call(PurposeTypeSeeder::class);
         $this->call(TradePermitStatusSeeder::class);
         $this->call(TradingTypeSeeder::class);
         $this->call(CitiesSeeder::class);
         $this->call(CategoriesSeeder::class);
         $this->call(SpeciesSeeder::class);
    }
}
