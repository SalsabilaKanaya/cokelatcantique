<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart_item_karakter', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('cart_item_id');
            $table->foreign('cart_item_id')->references('id')->on('cart_item')->onDelete('cascade');
            $table->string('karakter_cokelat_id', 14);
            $table->foreign('karakter_cokelat_id')->references('id')->on('karakter_cokelat')->onDelete('cascade');
            $table->integer('quantity');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_item_karakter');
    }
};
