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
        'harga_slop'
    ];

    public function satuan(){
        return $this->belongsTo('App\Models\SatuanBarang','satuan_id');
    }
}
