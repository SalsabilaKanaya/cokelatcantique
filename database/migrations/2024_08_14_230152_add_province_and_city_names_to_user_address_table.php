<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProvinceAndCityNamesToUserAddressTable extends Migration
{
    public function up()
    {
        Schema::table('user_address', function (Blueprint $table) {
            $table->string('province_name')->nullable();
            $table->string('city_name')->nullable();
        });
    }

    public function down()
    {
        Schema::table('user_address', function (Blueprint $table) {
            $table->dropColumn('province_name');
            $table->dropColumn('city_name');
        });
    }
}
