<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'barang_id',
        'jumlah'
    ];

    public function barang(){
        return $this->belongsTo('App\Models\DataBarang','barang_id');
    }
}
