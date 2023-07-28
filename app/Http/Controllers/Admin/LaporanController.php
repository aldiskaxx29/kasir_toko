<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index');
    }

    public function barangMasuk()
    {
        return view('admin.laporan.barangMasuk');
    }

    public function barangKeluar()
    {
        return view('admin.laporan.barangMasuk');
    }

    public function filterMasuk(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;

        $laporan = DB::table('barang_masuk')
            ->whereBetween('tanggal_masuk', [$dari, $sampai])
            ->get();

        return view('admin.laporan.tampilMasuk', compact('laporan'));
    }

    public function filterKeluar(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->samapi;

        $laporan = DB::table('barang_keluar')
            ->whereBetween('tanggal_keluar', [$dari, $sampai])
            ->get();

        return view('admin.laporan.tampilKeluar', compact('laporan'));
    }

    public function filter(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;
    }
}
