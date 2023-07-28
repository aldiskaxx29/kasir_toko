@extends('templates.app')

@section('title', 'Filter Laporan')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3>Laporan Pembelian</h3>
                </div>
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
                    </div>we
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                @if ($data)
                    <a href="{{ url('cetak-pdf') }}/{{ $dari }}/{{ $sampai }}" class="btn btn-danger m-3"
                        style="width: 100px;" target="_blank"><i class="fas fa-print"></i> Cetak</a>
                @endif
                <div class="card-body">
                    <table class="table table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Order</th>
                                <th>Nama Barang</th>
                                <th>Quantity</th>
                                {{-- <th>Harga Satuan</th> --}}
                                <th>Total Harga</th>
                                <th>Pembayaran</th>
                                <th>Kembalian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                
                            @endphp
                            @forelse ($data as $no => $item)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $item->transaksi->no_order }}</td>
                                    <td>{{ $item->barang->nama_barang }}</td>
                                    <td>{{ $item->transaksi->total_produk }}</td>
                                    {{-- <td>Rp. {{ number_format($item->harga_satuan, 0, ',', '.') }}</td> --}}
                                    <td>Rp. {{ number_format($item->transaksi->total_harga, 0, ',', '.') }}</td>
                                    <td>Rp. {{ number_format($item->transaksi->pembayaran, 0, ',', '.') }}</td>
                                    <td>Rp. {{ number_format($item->transaksi->kembalian, 0, ',', '.') }}</td>
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
