<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function create(Request $request){
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required',
        ]);
        dd($request->all());
        return response()->json(['message' => 'ini halaman create data'], 200);
    }

    public function logout(Request $request){
        $user = $request->user();
        dd($user);

        $user->currentAccessToken()->delete();

        return response()->json(['message' => 'Berhasil logout'], 200);
    }
}
