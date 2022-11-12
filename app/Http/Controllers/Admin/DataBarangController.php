<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataBarang;
use App\Models\SatuanBarang;
use Auth;

class DataBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = DataBarang::all();
        $satuan = SatuanBarang::all();
        return view('admin.data_barang.index', compact('barang','satuan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama_barang' => 'required',
            'stok' => 'required',
        ]);
        
        // $file = $request->file('foto_produk');
        // $name = time();
        // $extension = $file->getClientOriginalExtension();
        // $newName = $name . '.' . $extension;
        // Storage::putFileAs('public', $request->file('foto_produk'), $newName);
        // Storage::putFileAs('public/images', $request->file('foto_produk'), $newName);

        $data = $request->post();
        DataBarang::create($data);

        return redirect()->route('data-barang.index')->with('data_barang','Data Berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DataBarang::where('id', $id)->first();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'nama_barang' => 'required',
            'stok' => 'required',
         ]);

        $data = $request->post();
        $barang = DataBarang::findOrFail($id);
        $barang->update($data);
        return redirect()->route('data-barang.index')->with('data_barang','Data berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DataBarang::findOrFail($id)->delete();
        return redirect()->route('data-barang.index')->with('data_barang','Data berhasil di hapus');
    }
}
