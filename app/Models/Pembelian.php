<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_order',
        'nama_kasir',
        'barangs_id',
        'satuan_id',
        'quantity',
        'harga_satuan',
        'total_harga',
        'pembayaran',
        'kembalian'
    ];

    public function barang(){
        return $this->belongsTo('App\Models\DataBarang','barangs_id');
    }

    public function satuan(){
        return $this->belongsTo('App\Models\SatuanBarang','satuan_id');
    }
}
