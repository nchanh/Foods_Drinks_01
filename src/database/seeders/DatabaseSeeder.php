<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $admin = [
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'ADMIN'
    ];

    DB::table('users')->insert($admin);

        $this->call([
          CategoryTypeSeeder::class,
          CategoriesSeeder::class,
          ProductSeeder::class,
        ]);
    }
}
