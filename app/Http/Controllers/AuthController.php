<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function users(Request $request){
        $username = $request->username;
        $password = $request->password;

        $user = User::where('username', $username)->first();

        if ($user) {
            if (Auth::attempt(['username' => $username, 'password' => $password])) {
                if ($user->status) {
                    if ($user->role_user == 1) {
                        return redirect()->route('dashboard.admin');
                    } elseif($user->role_user == 2) {
                        return redirect()->route('dashboard.kepala.toko');
                    }
                }
                else{
                    return redirect()->back()->with('login','Akun tidak aktif');
                }
            } else {
                // return response()->json([
                //     'success' => false,
                //     'message' => 'password salah'
                // ]);
                return redirect()->back()->with('login','Password Salah');
            }
            
        } else {
            // return response()->json([
            //     'success' => false,
            //     'message' => 'username belum terdaftar'
            // ]);
            return redirect()->back()->with('login','Username tidak terdaftar');
        }
        
    }

    public function index(){
        return view('auth.login');
    }

    // public function login(Request $req){
    //     $email = $req->email;
    //     $password = $req->password;

    //     $req->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|min:6'
    //     ]);

    //     $user = DB::table('users')->where('email', $email)->first();
        
    //     if ($user) {
    //         if (Auth::attempt(['email' => $email, 'password' => $password])) {
    //             if (Auth::user()->status == 1) {
    //                if (Auth::user()->role_user == 1) {
    //                    return redirect('dashboard_admin');
    //                } else {
    //                    return redirect('dashboard');
    //                }
    //             } else {
    //                 return redirect('login')->with('login','Akun belum di aktifkan');
    //             }
                
    //         } else {
    //             return redirect('login')->with('login','email atau password salah');
    //         }
            
    //     } else {
    //        return redirect('login')->with('login','akun belum terdaftar');
    //     }
        
    // }

    public function regist(){
        return view('auth.regist');
    }

    public function daftar(Request $req){
        $req->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|same:password_confirm|min:6',
            'password_confirm' => 'required|same:password|min:6'
        ]);
        // dd($req->all());

        $name = $req->name;
        $email = $req->email;
        $password = $req->password;
        $password_confirm = $req->password_confirm;

        $user = new User;
        $user->nama = $name;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->role_user = 1;
        $user->status = 1;
        $user->save();

        return redirect('login')->with('login','Akun berhasil didaftarkan');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('regist','Berhasil Logout');
    }

    // jajal sanctum
    public function ogin(Request $request){
        $user = User::where('email', $request->email)->first();

        if (!$user || !\Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Password salah bos'], 401);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response()->json(['message' => 'success',
                                'user' => $user,
                                'token' => $token], 200);
    }
}
