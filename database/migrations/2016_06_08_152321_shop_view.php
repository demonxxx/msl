<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ShopView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW shop_view as select shops.*, users.code as user_code, users.name as user_name, users.username as username,
                        users.email, users.phone_number, users.identity_card,
                        unit_1.name as home_city_name, unit_2.name as home_district_name, unit_3.name as home_ward_name,
                        unit_4.name as office_city_name, unit_5.name as office_district_name, unit_6.name as office_ward_name,
                        shop_scopes.name as shop_scope_name, shop_types.name as shop_type_name from shops
                        join users on shops.user_id = users.id
                        left join administrative_units as unit_1 on shops.home_city_id = unit_1.id
                        left join administrative_units as unit_2 on shops.home_district_id = unit_2.id
                        left join administrative_units as unit_3 on shops.home_ward_id = unit_3.id
                        left join administrative_units as unit_4 on shops.office_city_id = unit_4.id
                        left join administrative_units as unit_5 on shops.office_district_id = unit_5.id
                        left join administrative_units as unit_6 on shops.office_ward_id = unit_5.id
                        left join shop_scopes on shops.shop_scope_id = shop_scopes.id
                        left join shop_types on shops.shop_type_id = shop_types.id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS shop_view');
    }
}
