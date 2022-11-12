@extends('templates.app')

@section('title', 'Barang Masuk')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@yield('title')</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @if (session('barang-masuk'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('barang-masuk') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                    </div>
                    @endif
                    <a href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary">Tambah Data</a>
                    <hr>
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Masuk</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($masuks as $no => $item)
                                <tr>
                                    <td>{{ $no+1 }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->barang->nama_barang }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>
                                        <form action="{{ route('hapus.barang.masuk', $item->id) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <a href="" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Tambah-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tambahBarangMasuk') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Barang</label>
                            <select name="barang_id" class="form-control" id="">
                                <option value="">-- Pilihan --</option>
                                @foreach ($barangs as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                                @endforeach
                            </select>
                            @error('nama_barang')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah</label>
                            <input type="number" class="form-control" name="jumlah" placeholder="Masukan Jumlah">
                            @error('jumlah')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" >
                            @error('tanggal')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="float-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-warning">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ubah-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tambahBarangMasuk') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Barang</label>
                            <select name="barang_id" class="form-control" id="">
                                <option value="">-- Pilihan --</option>
                                @foreach ($barangs as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                                @endforeach
                            </select>
                            @error('nama_barang')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah</label>
                            <input type="number" class="form-control" name="jumlah" placeholder="Masukan Jumlah">
                            @error('jumlah')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" >
                            @error('tanggal')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="float-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-warning">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
