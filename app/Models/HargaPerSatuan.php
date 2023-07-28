<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HargaPerSatuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id',
        'satuan_id',
        'harga'
    ];

    public function satuan(){
        return $this->belongsTo('App\Models\SatuanBarang','satuan_id');
    }

    public function barang(){
        return $this->belongsTo('App\Models\DataBarang','barang_id');
    }
}
