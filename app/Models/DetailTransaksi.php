<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi';

    protected $fillable = [
        'transaksi_id',
        'barangs_id',
        'quantity',
        'satuan_id',
        'harga_satuan'
    ];

    public function transaksi(){
        return $this->belongsTo('App\Models\Transaksi','transaksi_id');
    }

    public function barang(){
        return $this->belongsTo('App\Models\DataBarang','barangs_id');
    }

    public function satuan(){
        return $this->belongsTo('App\Models\SatuanBarang','satuan_id');
    }
}
