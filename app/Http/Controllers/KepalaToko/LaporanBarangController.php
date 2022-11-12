<?php

namespace App\Http\Controllers\KepalaToko;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use PDF;

class LaporanBarangController extends Controller
{
    public function barangMasuk(){
        return view('kepala_toko.laporan.barangMasuk');
    }

    public function barangKeluar(){
        return view('kepala_toko.laporan.barangKeluar');
    }

    public function filterMasuk(Request $request){
        try {
            $params = $request->post();
            $dari = $params['dari'];
            $sampai = $params['sampai'];
            $barangs = BarangMasuk::whereBetween('tanggal', [$params['dari'], $params['sampai']])->get();
            return view('kepala_toko.laporan.tampilMasuk', compact('barangs','dari','sampai'));
        } catch (\Exception $e) {
            return false;
        }
    }

    public function filterKeluar(Request $request){
        try {
            $params = $request->post();
            $dari = $params['dari'];
            $sampai = $params['sampai'];
            $barangs = BarangKeluar::whereBetween('tanggal', [$params['dari'], $params['sampai']])->get();
            return view('kepala_toko.laporan.tampilKeluar', compact('barangs','dari','sampai'));
        } catch (\Exception $e) {
            return false;
        }
    }

    public function cetakMasuk($dari, $sampai){
        $masuks = BarangMasuk::whereBetween('tanggal', [$dari, $sampai])->get();
        $hitung = DB::table('barang_masuks')
                ->leftJoin('data_barangs','barang_masuks.barang_id','=','data_barangs.id')
                ->select('barang_id',DB::raw('sum(jumlah) as jumlah'),'data_barangs.nama_barang as nama')
                ->groupBy('barang_id')
                ->whereBetween('tanggal', [$dari, $sampai])
                ->get();
        // dd($masuks);
        $pdf = PDF::loadView('kepala_toko.laporan.cetak_laporan_masuk', compact('masuks','dari','sampai','hitung'));
        return $pdf->stream('Cetak Laporan Masuk.pdf');
    }

    public function cetakKeluar($dari, $sampai){
        $keluars = BarangKeluar::whereBetween('tanggal', [$dari, $sampai])->get();
        $hitung = DB::table('barang_keluars')
                ->leftJoin('data_barangs','barang_keluars.barang_id','=','data_barangs.id')
                ->select('barang_id',DB::raw('sum(jumlah) as jumlah'),'data_barangs.nama_barang as nama')
                ->groupBy('barang_id')
                ->whereBetween('tanggal', [$dari, $sampai])
                ->get();
        $pdf = PDF::loadView('kepala_toko.laporan.cetak_laporan_keluar', compact('keluars','dari','sampai','hitung'));
        return $pdf->stream('Cetak Laporan Keluar.pdf');
    }
}
