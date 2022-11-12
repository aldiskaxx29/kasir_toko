<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MasukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\BarangMasuk::create([
            'nama_barang' => 'celana dalam',
            'kategori' => 'celana',
            // 'tangal_masuk' => 2022-05-16,
            'jumlah' => 20,
            'total_harga' => 100000,
            'supplier' => 'aldo'
        ]);
    }
}
