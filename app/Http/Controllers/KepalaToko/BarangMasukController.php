<?php

namespace App\Http\Controllers\KepalaToko;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\DataBarang;

class BarangMasukController extends Controller
{
    public function index()
    {
        try {
            $barangs = DataBarang::all();
            $masuks = BarangMasuk::all();
            return view('kepala_toko.barang_masuk.index', compact('masuks', 'barangs'));
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
            $barang->stok = $barang->stok + $params['jumlah'];
            $barang->save();
        }
        BarangMasuk::create($params);
        return redirect()->back()->with('barang-masuk', 'Data berhasil di tambahkan');
    }

    public function ubah(Request $request, $id)
    {
        try {
            $request->validate([
                'barang_id' => 'required',
                'tanggal' => 'required',
                'jumlah' => 'required'
            ]);
            $params = $request->post();
            $barang = BarangMasuk::find($id);
            // $barang->jumlah = $jml;
            $barangs = DataBarang::where('id', $params['barang_id'])->first();
            $jml = $barangs->stok - $barang->jumlah  + $params['jumlah'];
            $barangs->stok = $jml;
            $barangs->save();
            $barang->update($params);

            return redirect()->back()->with('barang-masuk', 'Data berhasil di tambahkan');
        } catch (\Exception $e) {
            return false;
        }
    }

    public function hapus(Request $request, $id)
    {
        $params = $request->post();
        BarangMasuk::findOrFail($id)->delete();
        return redirect()->back()->with('barang-masuk', 'Data berhasil di hapus');
    }
}
