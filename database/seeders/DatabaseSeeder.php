<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Location;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            // ItemSeeder::class,
            // LocationSeeder::class,
            // ConditionSeeder::class
            ArticleSeeder::class,
            TypesSeeder::class,
            StatusSeeder::class,
            ManuSeeder::class,
            SupplierSeeder::class,
            UnitSeeder::class,
            Variety::class,
            BrandSeeder::class,
            CountrySeeder::class,
            AcquisionSeeder::class,
            AcquisourceSeeder::class,
            AcquiModeSeeder::class,
            ItemSeeder::class,
            LocationSeeder::class,
            ConditionSeeder::class,
            AssocSeeder::class,
            LocatmanSeeder::class,
            InventorySeeder::class
        ]);
    }
}