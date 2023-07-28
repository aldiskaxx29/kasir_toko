<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBarang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'satuan_id',
        'stok',
        'harga',
        'harga_pcs',
        'harga_dus',
        'harga_slop',
        'harga_modal'
    ];

    public function satuan()
    {
        return $this->belongsTo('App\Models\SatuanBarang', 'satuan_id');
    }

    public function harga()
    {
        return $this->hasOne('App\Models\HargaPerSatuan', 'id');
    }
}
