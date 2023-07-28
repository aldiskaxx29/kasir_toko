@extends('templates.app')

@section('title', 'Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@yield('title')</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-drumstick-bite"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Data Barang</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $dataBarang }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-info">
                                    <i class="far fa-calendar-plus"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Barang Masuk</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $barangMasuk }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-warning">
                                    <i class="far fa-calendar-minus"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Barang Keluar</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $barangKeluar }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-secondary">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>User</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $user }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h4>Data Pembelian PerBulan Ini</h4>
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Order</th>
                                        <th>Total Produk</th>
                                        <th>Total Harga</th>
                                        <th>Pembayaran</th>
                                        <th>Kembalian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $no => $d)
                                        <tr>
                                            <td>{{ $no + 1 }}</td>
                                            <td>{{ $d->no_order }}</td>
                                            <td>{{ $d->total_produk }}</td>
                                            <td>Rp. {{ number_format($d->total_harga, 0, ',', '.') }}</td>
                                            <td>Rp. {{ number_format($d->pembayaran, 0, ',', '.') }}</td>
                                            <td>Rp. {{ number_format($d->kembalian, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
