<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHargaSatuanToDataBarangs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_barangs', function (Blueprint $table) {
            $table->string('harga_pcs')->nullable();
            $table->string('harga_dus')->nullable();
            $table->string('harga_slop')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_barangs', function (Blueprint $table) {
            $table->dropColumn('harga_pcs');
            $table->dropColumn('harga_dus');
            $table->dropColumn('harga_slop');
        });
    }
}
