@extends('templates.app')

@section('title', 'Data Barang')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@yield('title')</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-bdoy">
                    @if (session('data_barang'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('data_barang') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i
                            class="fas fa-plus"></i>
                        Tambah Data</a>
                    <hr>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Satuan</th>
                                <th>Stok</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($barangs as $no => $item)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ $item->satuan_id }}</td>
                                    <td>{{ $item->stok }}</td>
                                    <td>
                                        <form action="" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <a href="" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
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
                    <form action="" method="">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Barang</label>
                            <input type="text" class="form-control" name="nama_barang" placeholder="Masukan Nama Barang">
                            @error('nama_barang')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Satuan</label>
                            <select name="satuan_id" class="form-control" id="">
                                <option value="">-- Pilhan --</option>
                                @foreach ($satuan as $item)
                                    <option value="{{ $item->id }}">{{ $item->satuan }}</option>
                                @endforeach
                            </select>
                            @error('satuan_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Stok</label>
                            <input type="number" class="form-control" name="stok" placeholder="Masukan Stok">
                            @error('stok')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
