<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderAddressesTable extends Migration
{
    public function up()
    {
        Schema::create('order_addresse', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('order')->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('delivery_date');
            $table->text('address');
            $table->string('subdistrict');
            $table->string('city');
            $table->string('province');
            $table->string('postal_code');
            $table->decimal('shipping_cost', 10, 2); // Ongkir
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_addresse');
    }
}
