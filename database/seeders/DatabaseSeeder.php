<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'Kyroline',
            'firstname' => 'Karol',
            'lastname' => 'Lynn',
            'email' => 'kyroline@lynn.com',
            'password' => bcrypt('secret')
        ]);

        DB::table('stores')->insert([
            'user_id' => 7000000,
            'store_id' => 'ST7000000',
            'store_domain' => 'kyro-store',
            'store_name' => 'Kyroline\'s Store'
        ]);
    }
}
