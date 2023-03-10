<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call([
            CategorySeeder::class,
            SupplierSeeder::class,
            ProductSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            PrivilegeSeeder::class,
            WhsDetailSeeder::class,
            BranchSeeder::class,
            WarehouseSeeder::class,
            ProductOrderRequestSeeder::class,
        ]);
    }
}
