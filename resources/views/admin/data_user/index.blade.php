@extends('templates.app')

@section('title', 'Data User')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@yield('title')</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body" style="overflow-x:scroll;">
                    @if (session('data-user'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('data-user') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                    @endif
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i
                            class="fas fa-plus"></i>
                        Tambah Data</a>
                    <hr>
                    <table class="table table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Role User</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $no => $item)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>
                                        @if ($item->role_user == 1)
                                            <small class="badge badge-success">Kasir</small>
                                        @else
                                            <small class="badge badge-info">Kepala Toko</small>
                                        @endif
                                    </td>
                                    <td>{{ $item->status == 1 ? 'Aktif' : 'TIdak Aktif' }}</td>
                                    <td>
                                        <form action="{{ route('users.destroy', $item->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="#" data-toggle="modal" data-target="#exampleModal{{ $item->id }}"
                                                class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                            <button onclick="return confirm('Yakin ingin di hapus')" type="submit"
                                                class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="alert alert-danger">Data tidak ada</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('addon-modal')
    <!-- Modal Tambah-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal Tambah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" placeholder="Nama" name="nama">
                            @error('nama')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="username" class="form-control" name="username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="">Konfirmasi Password</label>
                            <input type="password" class="form-control" name="password_konfirmasi" placeholder="Password Konfirmasi">
                        </div>
                        <div class="form-group">
                            <label for="">Role User</label>
                            <select name="role_user" class="form-control" id="">
                                <option value="">-- Pilihan --</option>
                                <option value="2">Kepala Toko</option>
                                <option value="1">Kasir</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" class="form-control" id="">
                                <option value="">-- Pilihan --</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="float-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-warning">Save</button>
                        </div>
                        <div style="height: 20px"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ubah-->
    @foreach ($users as $item)
        <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal Tambah</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="height:370px;overflow-y:auto;">
                        <form action="{{ route('users.update', $item->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" placeholder="Nama" name="nama"
                                    value="{{ $item->nama }}">
                                @error('nama')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="username" class="form-control" name="username" placeholder="username"
                                    value="{{ $item->username }}">
                                @error('username')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <small><i>Kosongkan jika tidak ingin mengubah password</i></small>
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Konfirmasi Password</label>
                                <input type="password" class="form-control" name="password_konfirmasi" placeholder="Konfirmasi Password">
                                @error('password_konfirmasi')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Role User</label>
                                <select name="role_user" class="form-control" id="">
                                    <option value="2" @if ($item->role_user == '2') selected @endif>Kepala Toko</option>
                                    <option value="1" @if ($item->role_user == '1') selected @endif>Kasir</option>
                                </select>
                                @error('role_user')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Status</label>
                                <select name="status" class="form-control" id="">
                                    <option value="1" @if ($item->status == '1') selected @endif>Aktif
                                    </option>
                                    <option value="0" @if ($item->status == '0') selected @endif>Tidak Aktif
                                    </option>
                                </select>
                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="float-right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-warning">Save</button>
                            </div>
                            <div style="height: 20px"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endpush
