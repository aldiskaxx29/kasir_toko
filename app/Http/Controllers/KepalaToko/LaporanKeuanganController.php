<?php

namespace App\Http\Controllers\KepalaToko;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\HargaPerSatuan;
use PDF;

class LaporanKeuanganController extends Controller
{
    public function laporanHarian()
    {
        return view('kepala_toko.laporan-keuangan.laporan-keuangan-harian.index');
    }

    public function laporanHarianAction(Request $request)
    {
        $request->validate([
            'tanggal' => 'required'
        ]);
        $params = $request->post();
        $tanggal = $params['tanggal'];
        $transaksi = Transaksi::with(['detailTransaksi.barang'])->whereDate('created_at', $params['tanggal'])->get();
        $data = DetailTransaksi::with(['transaksi', 'barang', 'satuan'])->whereDate('created_at', $params['tanggal'])->get();
        $perSatuans = [];
        $keuntungan = [];
        foreach ($data as $item) {
            $perSatuan = HargaPerSatuan::where('barang_id', $item->barangs_id)->where('satuan_id', $item->satuan_id)->first();
            // dd($item->detailTransaksi);
            array_push($perSatuans, $perSatuan);
            $untung = $perSatuan->harga * $item->quantity;
            $modal = $item->barang->harga_modal * $item->quantity;
            $keseluruhan = $untung - $modal;
            array_push($keuntungan, $keseluruhan);
        }

        $totalKeuntungan = array_sum($keuntungan);

        return view('kepala_toko.laporan-keuangan.laporan-keuangan-harian.filter-laporan-keuangan-harian', compact('data', 'perSatuans', 'keuntungan', 'tanggal', 'totalKeuntungan', 'transaksi'));
    }

    public function cetakLaporanHarian($tanggal)
    {
        $transaksi = Transaksi::with(['detailTransaksi.barang'])->whereDate('created_at', $tanggal)->get();
        $data = DetailTransaksi::with(['transaksi', 'barang', 'satuan'])->whereDate('created_at', $tanggal)->get();
        $perSatuans = [];
        $keuntungan = [];
        foreach ($data as $item) {
            $perSatuan = HargaPerSatuan::where('barang_id', $item->barangs_id)->where('satuan_id', $item->satuan_id)->first();
            array_push($perSatuans, $perSatuan);
            $untung = $perSatuan->harga * $item->quantity;
            $modal = $item->barang->harga_modal * $item->quantity;
            $keseluruhan =  $untung - $modal;
            array_push($keuntungan, $keseluruhan);
        }

        $totalKeuntungan = array_sum($keuntungan);

        $pdf = PDF::loadView('kepala_toko.laporan-keuangan.laporan-keuangan-harian.cetak-laporan-keuangan-harian', compact('data', 'perSatuans', 'keuntungan', 'tanggal', 'totalKeuntungan', 'transaksi'));
        return $pdf->stream('Laporan Harian.pdf');
    }

    public function laporanBulanan(Request $request)
    {
        return view('kepala_toko.laporan-keuangan.laporan-keuangan-bulanan.index');
    }

    public function laporanBulananAction(Request $request)
    {
        $request->validate([
            'bulan' => 'required'
        ]);

        $params = $request->post();
        // dd(substr($params['bulan'], 5), substr($params['bulan'], 0, -3));
        $bulan = substr($params['bulan'], 5);
        $tahun = substr($params['bulan'], 0, -3);
        $transaksi = Transaksi::whereYear('created_at', $tahun)->whereMonth('created_at', $bulan)->get();
        $data = DetailTransaksi::whereYear('created_at', $tahun)->whereMonth('created_at', $bulan)->get();
        $perSatuans = [];
        $keuntungan = [];
        foreach ($data as $item) {
            $perSatuan = HargaPerSatuan::where('barang_id', $item->barangs_id)->where('satuan_id', $item->satuan_id)->first();
            array_push($perSatuans, $perSatuan);
            $untung = $perSatuan->harga * $item->quantity;
            $modal = $item->barang->harga_modal * $item->quantity;
            $keseluruhan =  $untung - $modal;
            array_push($keuntungan, $keseluruhan);
        }
        $totalKeuntungan = array_sum($keuntungan);

        return view('kepala_toko.laporan-keuangan.laporan-keuangan-bulanan.filter-laporan-keuangan-bulanan', compact('data', 'perSatuans', 'keuntungan', 'totalKeuntungan', 'transaksi', 'bulan', 'tahun'));
    }

    public function cetakLaporanBulanan($bulan, $tahun)
    {
        $transaksi = Transaksi::whereYear('created_at', $tahun)->whereMonth('created_at', $bulan)->get();
        $data = DetailTransaksi::whereYear('created_at', $tahun)->whereMonth('created_at', $bulan)->get();
        $perSatuans = [];
        $keuntungan = [];
        foreach ($data as $item) {
            $perSatuan = HargaPerSatuan::where('barang_id', $item->barangs_id)->where('satuan_id', $item->satuan_id)->first();
            array_push($perSatuans, $perSatuan);
            $untung = $perSatuan->harga * $item->quantity;
            $modal = $item->barang->harga_modal * $item->quantity;
            $keseluruhan =  $untung - $modal;
            array_push($keuntungan, $keseluruhan);
        }
        $totalKeuntungan = array_sum($keuntungan);

        $pdf = PDF::loadView('kepala_toko.laporan-keuangan.laporan-keuangan-bulanan.cetak-laporan-keuangan-bulanan', compact('data', 'perSatuans', 'keuntungan', 'bulan', 'tahun', 'totalKeuntungan', 'transaksi'));
        return $pdf->stream('Laporan Bulanan.pdf');
    }

    public function laporanTahunan()
    {
    }
}
