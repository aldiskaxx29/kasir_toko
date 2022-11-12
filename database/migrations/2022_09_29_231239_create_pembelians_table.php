<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->string('no_order')->nullable();
            $table->string('nama_kasir')->nullable();
            $table->foreignId('barangs_id')->constrained('data_barangs')->onDelete('cascade');
            $table->integer('quantity')->nullable();
            $table->foreignId('satuan_id')->constrained('satuan_barangs')->onDelete('cascade');
            $table->string('harga_satuan')->nullable();
            $table->string('total_harga')->nullable();
            $table->integer('pembayaran')->nullable();
            $table->integer('kembalian')->nullable();
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
        Schema::dropIfExists('pembelians');
    }
}
