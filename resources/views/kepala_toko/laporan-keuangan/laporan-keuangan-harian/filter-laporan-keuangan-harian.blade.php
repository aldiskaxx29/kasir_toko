@extends('templates.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Filter Laporan Keuangan Harian</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('laporan-keuangan-harian-action') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal">
                                    @error('tanggal')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-warning">Cari</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div>Larporan Keuangan Harian Per Tanggal {{ $tanggal }}</div>
                            @if (count($data) !== 0)
                                <a href="{{ url('laporan/laporan-keuangan-harian/cetak/' . $tanggal) }}"
                                    class="btn btn-warning my-2" target="_blank">Cetak Laporan</a>
                            @endif
                            <table class="table" id='dataTable'>
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>No Order</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Total Produk</th>
                                        <th>Harga Satuan</th>
                                        <th>Total Harga</th>
                                        <th>Pembayaran</th>
                                        <th>Harga Modal</th>
                                        <th>Keuntungan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $key => $item)
                                        <tr>
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ $item->transaksi->no_order }}</td>
                                            <td>{{ $item->transaksi->nama_pelanggan }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>Rp. {{ number_format($perSatuans[$key]->harga, 0, ',', '.') }}</td>
                                            <td>Rp. {{ number_format($item->sub_total, 0, ',', '.') }}</td>
                                            <td>Rp. {{ number_format($item->transaksi->pembayaran, 0, ',', '.') }}</td>
                                            <td>Rp.{{ number_format($item->barang->harga_modal, 0, ',', '.') }}
                                            </td>
                                            <td>Rp.
                                                {{ number_format($keuntungan[$key], 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">Data Tidak Di Temukan</div>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table">
                                        <tr>
                                            <th>Total Keuntungan</th>
                                            <th>Rp. {{ number_format($totalKeuntungan, 0, ',', '.') }}</th>
                                        </tr>
                                        <tr>
                                            <th>Total Pelanggan</th>
                                            <th>{{ count($transaksi) }}</th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
