<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id'   => 1,
            'name' => 'Shop',
            'username' => 'shop',
            'code' => 'KH123',
            'email' => 'shop@mslvn.com',
            'password' => bcrypt('Abc@@123'),
            'api_token' => str_random(60),
        ]);

        DB::table('users')->insert([
            'id'   => 2,
            'name' => 'Shipper',
            'username' => 'shipper',
            'code' => 'TX123',
            'email' => 'shipper@mslvn.com',
            'password' => bcrypt('Abc@@123'),
            'api_token' => str_random(60),
        ]);

        DB::table('users')->insert([
            'id'   => 3,
            'name' => 'Admin',
            'username' => 'admin',
            'code' => 'AD123',
            'email' => 'admin@mslvn.com',
            'password' => bcrypt('Abc@@123'),
            'api_token' => str_random(60),
        ]);
    }
}
