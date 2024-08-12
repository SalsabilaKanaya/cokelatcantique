<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_item', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key (orderitem_id)
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('order')->onDelete('cascade');
            $table->string('jenis_cokelat_id', 14);
            $table->foreign('jenis_cokelat_id')->references('id')->on('jenis_cokelat')->onDelete('cascade');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_item');
    }
}
