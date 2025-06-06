<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(BlogCategoriesTableSeeder::class);
        \App\Models\BlogPost::factory(100)->create();
    }
}