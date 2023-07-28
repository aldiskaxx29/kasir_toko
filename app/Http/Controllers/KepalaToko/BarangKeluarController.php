<?php

namespace App\Http\Controllers\KepalaToko;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangKeluar;
use App\Models\DataBarang;

class BarangKeluarController extends Controller
{
    public function index()
    {
        try {
            $barangs = DataBarang::all();
            $keluars = BarangKeluar::all();
            return view('kepala_toko.barang_keluar.index', compact('barangs', 'keluars'));
        } catch (\Exception $e) {
            return false;
        }
    }

    public function save(Request $request)
    {
        $request->validate([
            'barang_id' => 'required',
            'tanggal' => 'required',
            'jumlah' => 'required'
        ]);
        $params = $request->post();
        $barang = DataBarang::where('id', $params['barang_id'])->first();
        if ($barang) {
            $barang->stok = $barang->stok - $params['jumlah'];
            $barang->save();
        }
        BarangKeluar::create($params);
        return redirect()->back()->with('barang-keluar', 'Data berhasil di tambahkan');
    }

    public function ubah(Request $request, $id)
    {
        $request->validate([
            'barang_id' => 'required',
            'tanggal' => 'required',
            'jumlah' => 'required'
        ]);

        $params = $request->post();
        $barang = BarangKeluar::find($id);
        $barangs = DataBarang::where('id', $params['barang_id'])->first();
        $jml = $barangs->stok + $barang->jumlah  - $params['jumlah'];
        $barangs->stok = $jml;
        $barangs->save();
        $barang->update($params);
        return redirect()->back()->with('barang-keluar', 'Data berhasil di ubah');
    }

    public function hapus(Request $request, $id)
    {
        BarangKeluar::find($id)->delete();
        return redirect()->back()->with('barang-keluar', 'Data berhasil di hapus');
    }
}
