<?php

namespace App\Http\Controllers\KepalaToko;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataBarang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;

class DashboardTokoController extends Controller
{
    public function index()
    {
        $date = Carbon::now();
        $dataBarang = DataBarang::count();
        $barangMasuk = BarangMasuk::count();
        $barangKeluar = BarangKeluar::count();
        $pembelian = Transaksi::count();
        $user = User::count();
        $data = Transaksi::whereMonth('created_at', $date->month)->get();
        return view('kepala_toko.dashboard', compact('dataBarang', 'barangMasuk', 'barangKeluar', 'user', 'data'));
    }
}
