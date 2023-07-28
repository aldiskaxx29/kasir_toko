<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'no_order',
        'nama_pelanggan',
        'nama_kasir',
        'total_produk',
        'total_harga',
        'pembayaran',
        'kembalian'
    ];

    public function detailTransaksi()
    {
        return $this->hasOne('App\Models\DetailTransaksi', 'transaksi_id', 'id');
    }
}
