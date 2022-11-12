<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\User;
use App\Models\DataBarang;
use App\Models\SatuanBarang;
use App\Models\HargaPerSatuan;
use Auth;
use PDF;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembelian = Transaksi::all();
        $barang = DataBarang::all();
        $satuans = SatuanBarang::get();
        return view('admin.data_pembelian.index', compact('pembelian','barang','satuans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = DataBarang::orderBy('nama_barang','asc')->where('stok', '!=', 0)->get();
        $satuans = SatuanBarang::get();
        return view('admin.data_pembelian.create', compact('barang','satuans'));
        // return view('admin.data_pembelian.typehead', compact('barang','satuans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->post();
        dd($data);
        $request->validate([
            'barangs_id' => 'required',
            'satuan_id' => 'required',
            'quantity' => 'required',
            'pembayaran' => 'required',
        ]);

        $harga = null;
        foreach ($data['harga'] as $key => $value) {
            $harga[] = $value * $data['quantity'][$key];
        }
        $total_harga = array_sum($harga);

        $total_produk = null;
        foreach ($data['quantity'] as $key => $value) {
            $total_produk = $total_produk + $value;
        }
        
        if ($total_harga > $data['pembayaran']) {
            return redirect()->back()->with('pembelian_error','Pembayaran Kurang');
        }
        foreach ($data['barangs_id'] as $key => $value) {
            $barang = DataBarang::find($value);
            if ($barang->stok < $data['quantity'][$key]) {
                return redirect()->back()->with('pembelian_error','Quantity melebihi stok produk');
            }
            $barang->stok = $barang->stok - $data['quantity'][$key];
            $barang->save();
        }

        $transaksi = new Transaksi();
        $transaksi->no_order = '00-'.date('Ymd').rand(111,999);
        $transaksi->nama_kasir = auth()->user()->nama;
        $transaksi->total_produk = $total_produk;
        $transaksi->total_harga = $total_harga;
        $transaksi->pembayaran = $data['pembayaran'] ;
        $transaksi->kembalian = $data['pembayaran'] - $total_harga;
        $transaksi->save();

        foreach ($data['barangs_id'] as $key => $value) {
            // $barang = DataBarang::where('id', $value)->first();
            $detai_transaksi =  new DetailTransaksi();
            $detai_transaksi->transaksi_id = $transaksi->id;
            $detai_transaksi->barangs_id = $value;
            $detai_transaksi->quantity = $data['quantity'][$key];
            $detai_transaksi->satuan_id = $data['satuan_id'][$key];
            $detai_transaksi->sub_total = $data['harga'][$key] * $data['quantity'][$key];
            $detai_transaksi->save();
        }
        return redirect()->route('data-pembelian.index')->with('data-pembelian','Data berhasil di tambahkan');
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
        $validate = Validator::make($request->all(), [
            'barangs_id' => 'required',
            'satuan_id' => 'required',
            'quantity' => 'required',
            'pembayaran' => 'required',
            'total_harga' => 'required',
            'kembalian' => 'required',
        ]);
        $params = $request->post();

        $data = Pembelian::where('id', $id)->first();
        $data->fill($params);
        $data->save($params);
        return redirect()->back()->with('data-pembelian','Data berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transaksi::find($id)->delete();
        DetailTransaksi::where('transaksi_id', $id)->delete();
        return redirect()->back()->with('data-pembelian','Data berhasil di hapus');
    }

    public function laporan(){
        return view('admin.laporan.index');
    }

    public function filter(Request $request){
        $params = $request->post();
        $dari = $params['dari'];
        $sampai = $params['sampai'];
        $data = Pembelian::whereBetween('created_at', [$params['dari'], $params['sampai']])->get();
        return view('admin.laporan.filter', compact('data','dari','sampai'));
    }

    public function cetakPdf($dari, $sampai){
        $data = Pembelian::whereBetween('created_at', [$dari, $sampai])->get();
        $harga_satuan = [];
        $total_harga = [];
        $pembayaran = [];
        $kembalian = [];
        foreach ($data as $key => $value) {
            $total_harga[] = $value->total_harga;
            $harga_satuan[] = $value->harga_satuan;
            $pembayaran[] = $value->pembayaran;
            $kembalian[] = $value->kembalian;
        }
        $harga_satuan = array_sum($harga_satuan);
        $total_harga = array_sum($total_harga);
        $pembayaran = array_sum($pembayaran);
        $kembalian = array_sum($kembalian);
        
        $pdf = PDF::loadView('admin.laporan.cetak_laporan', compact('data','dari','sampai','total_harga','harga_satuan','pembayaran','kembalian'));
        $pdf->set_paper('letter', 'landscape');
        return $pdf->download('Cetak Laporan Pembelian.pdf');
    }

    public function cetak($id){
        $transaksi = Transaksi::where('id', $id)->first();
        $data = DetailTransaksi::with(['transaksi','barang','satuan'])->where('transaksi_id', $id)->get();
        $pdf = PDF::loadView('admin.data_pembelian.cetak_struk', compact('data','transaksi'));
        return $pdf->stream('Pembelian.pdf');
    }

    public function action(Request $request){
        $params = $request->post();

        $query = $params['query'];

        $filter_data = DataBarang::orderBy('nama_barang','asc')
                    ->select('nama_barang','harga')
                    ->where('nama_barang','LIKE', '%'.$query.'%')
                    ->get();

                    
        $data = array();
        foreach ($filter_data as $hsl)
        {
            $data[] = $hsl->nama_barang;
            // $data[] = $hsl->harga;
            // $data[] = [
            //     'barang' => $hsl->nama_barang,
            //     'harga' => $hsl->harga
            // ];
            // $arr = [$hsl->nama_barang, $hsl->harga];
            // array_push($data, $arr);
        }
        
        return response()->json($data);
    }

    public function barangSatuan($id){
        $data = HargaPerSatuan::with('satuan')->where('barang_id', $id)->get();
        return $data;
    }
}
