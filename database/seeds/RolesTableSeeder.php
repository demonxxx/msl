<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id'   => 1,
            'name' => 'shop',
            'display_name' => 'Shop',
            'description' => 'Role cho Shop'
        ]);

        DB::table('roles')->insert([
            'id'   => 2,
            'name' => 'shipper',
            'display_name' => 'Shipper',
            'description' => 'Role cho Shipper'
        ]);

        DB::table('roles')->insert([
            'id'   => 3,
            'name' => 'admin',
            'display_name' => 'Amin',
            'description' => 'Role cho Amin'
        ]);
    }
}
