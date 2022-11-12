<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use File;

class DataUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.data_user.index', compact('users'));
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
        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'role_user' => 'required',
            'status' => 'required',
            'password' => 'required|same:password_konfirmasi|min:6',
            'password_konfirmasi' => 'required|same:password|min:6'
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        User::create($data);

        return redirect()->back()->with('data-user','Data berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'role_user' => 'required',
            'status' => 'required',
            'password' => 'nullable|same:password_konfirmasi|min:6',
            'password_konfirmasi' => 'nullable|same:password|min:6'
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $user = User::findOrFail($id);
        $user->update($data);

        return redirect()->back()->with('data-user','Data berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back()->with('data-user','Data berhasil di hapus');
    }

    public function ubahProfile(Request $request){
        $params = $request->post();

        $user = User::where('id', $params['id'])->first();
        if($request->hasFile('foto')){
            File::delete($user->foto);
        }
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $fileName = time().'.'. $extension;
            $file->move('upload/user/', $fileName);
            $params['foto'] = 'upload/user/'. $fileName;
        }
        $user->fill($params);
        $user->save($params);
        return redirect()->back()->with('user','Profile berhasil di ubah');
    }
}
