@extends('templates.app')

@section('title', 'Filter Laporan')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('filter.laporan') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Dari Tanggal</label>
                                    <input type="date" class="form-control" name="dari">
                                </div>
                                <div class="form-group">
                                    <label for="">Sampai Tanggal</label>
                                    <input type="date" class="form-control" name="sampai">
                                </div>
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pembeli</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Total Harga</th>
                                <th>Tanggal Pembelian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $no => $item)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $item->nama_pembeli }}</td>
                                    <td>{{ $item->barang->nama_barang }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>Rp. {{ number_format($item->total_harga,0,',','.') }}</td>
                                    <td>{{ $item->tanggal_pembelian }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <div class="alert alert-danger">Data Tidak Ada</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
