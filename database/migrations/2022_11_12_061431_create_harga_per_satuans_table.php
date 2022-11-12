<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHargaPerSatuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('harga_per_satuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->constrained('data_barangs')->onDelete('cascade');
            $table->foreignId('satuan_id')->constrained('satuan_barangs')->onDelete('cascade');
            $table->integer('harga');
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
        Schema::dropIfExists('harga_per_satuans');
    }
}
