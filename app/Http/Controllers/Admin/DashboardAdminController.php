<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataBarang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;


class DashboardAdminController extends Controller
{
    public function index(){
        $date = Carbon::now();
        // dd($date->month);
        $dataBarang = DataBarang::count();
        $barangMasuk = BarangMasuk::count();
        $barangKeluar = BarangKeluar::count();
        $pembelian = Transaksi::count();
        $user = User::count();

        // $data = DB::table('transaksi')
        //          ->leftJoin('detail_transaksi','transaksi.id','=','detail_transaksi.transaksi_id')
        //          ->leftJoin('data_barangs','detail_transaksi.barangs_id','=','data_barangs.id')
        //          ->select('barangs_id', DB::raw('sum(detransaksi.quantity) as total'),'data_barangs.nama_barang as nama', DB::raw('sum(transaksi.total_harga) as total_harga'))
        //          ->groupBy('barangs_id')
        //          ->whereMonth('transaksi.created_at', 10)
        //          ->get();
        $data = Transaksi::whereMonth('created_at', $date->month)->get();
        $p = DB::table('transaksi')
        ->select(DB::raw('count(id) as data'),  DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
        ->groupBy('year','month')
        ->orderBY('month','desc')
        ->get();
        // $mm = date("F", '2');
        // dd($mm);
        // dd($p);

        $chart = '';
        foreach ($data as $item) {
            $chart .= "['".$item->no_order."', ".$item->total_produk."],";
        }
        $diagram = $chart;


        return view('admin.dashboard', compact('dataBarang','barangMasuk','barangKeluar','pembelian','user','diagram','data','p'));
    }

    public function profile(){
        $user = User::where('id', Auth::user()->id)->first();
        return view('admin.profile', compact('user'));
    }

    public function bottom(){
        return view('admin.bottom');
    }
}
