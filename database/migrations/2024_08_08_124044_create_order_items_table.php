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
            $table->unsignedBigInteger('orderitem_id')->primary();
            $table->unsignedBigInteger('order_id'); // Foreign key untuk 'order'
            $table->foreign('order_id')->references('order_id')->on('order')->onDelete('cascade');
            $table->string('jenis_cokelat_id', 14); // Menggunakan 'jenis_cokelat_id' dengan tipe yang sesuai
            $table->foreign('jenis_cokelat_id')->references('id')->on('jenis_cokelat')->onDelete('cascade');
            $table->string('karakter_cokelat_id')->nullable(); // Foreign key untuk 'karakter_cokelat'
            $table->foreign('karakter_cokelat_id')->references('id')->on('karakter_cokelat')->onDelete('cascade');
            $table->integer('quantity');
            $table->text('notes')->nullable(); // Catatan untuk karakter cokelat
            $table->decimal('price', 10, 2); // Harga per item
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
