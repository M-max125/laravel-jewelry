<?php

namespace Database\Seeders;

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
        Schema::disableForeignKeyConstraints();
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        Schema::enableForeignKeyConstraints();
    
    }
   
}
