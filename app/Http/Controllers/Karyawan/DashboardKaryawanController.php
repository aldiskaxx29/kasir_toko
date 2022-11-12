<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardKaryawanController extends Controller
{
    public function index(){
        return view('karyawan.dashboard');
    }

    public function profile(){
        $user = User::findOrFail(Auth::user()->id);
        return view('karyawan.profile', compact('user'));
    }

    public function dataBarang()    {
        $barangs = DataBarang::all();
        return view('karyawan.data_barang', compact('barangs'));
    }
}
