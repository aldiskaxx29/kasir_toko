@extends('templates.app')

@section('title', 'Profile')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Profil User</h1>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if (session('user'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('user') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                            </div>
                        @endif
                        @if ($user->foto != null && $user->foto != 'default.png')
                            <img alt="image" src="{{ asset($user->foto) }}" class="w-100">
                        @else   
                            <img alt="image" src="../assets/img/avatar/avatar-1.png" class="w-100">
                        @endif
                        <form action="{{ route('ubah.profile') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}" class="form-control">
                            <input type="file" name="foto" class="form-control">
                            <button class="btn btn-warning mt-2" type="submit">Simpan</button>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <table class="table">
                            <tr>
                                <th>Nama</th>
                                <td>{{ $user->nama }}</td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td>{{ $user->username }}</td>
                            </tr>
                            <tr>
                                <th>Role User</th>
                                <td>
                                    @if ($user->role_user == 1)
                                        <small class="badge badge-success">Kasir</small>
                                    @else
                                        <small class="badge badge-info">Kepala Toko</small>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ $user->status == 1 ? 'Aktif' : 'TIdak Aktif' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
