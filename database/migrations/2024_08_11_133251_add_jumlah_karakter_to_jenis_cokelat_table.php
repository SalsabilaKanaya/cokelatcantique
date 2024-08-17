<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJumlahKarakterToJenisCokelatTable extends Migration
{
    public function up()
    {
        Schema::table('jenis_cokelat', function (Blueprint $table) {
            $table->integer('jumlah_karakter')->nullable(); // Menambahkan kolom jumlah_karakter
        });
    }

    public function down()
    {
        Schema::table('jenis_cokelat', function (Blueprint $table) {
            $table->dropColumn('jumlah_karakter'); // Menghapus kolom jika migrasi dibalik
        });
    }
}
