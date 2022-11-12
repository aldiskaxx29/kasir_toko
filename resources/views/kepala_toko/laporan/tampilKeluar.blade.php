@extends('templates.app')

@section('title', 'Filter Laporan')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Laporan Barang Keluar</h1>
    </div>
    <div class="section-body">
        <div class="row" id="filter">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{ route('filterKeluar') }}" method="post">
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
                                    <button type="button" class="btn btn-secondary" id="tutup">Tutup</button>
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
                        <button class="btn btn-primary" id="tampil">Tampil Filter</button>
                        <a href="{{ url('cetak-keluar') }}/{{ $dari }}/{{ $sampai }}" class="btn btn-warning" target="_blank"><i class="fas fa-file"></i> Cetak</a>
                        <hr>
                        <table class="table tabl-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($barangs) == 0)
                                    <div class="alert alert-danger">Data Kosong</div>
                                @else
                                    @foreach ($barangs as $no => $item)
                                        <tr>
                                            <td>{{ $no + 1 }}</td>
                                            <td>{{ $item->barang->nama_barang }}</td>
                                            <td>{{ $item->tanggal }}</td>
                                            <td>{{ $item->jumlah }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('addon-script')
    <script>
        $(document).ready(function() {
            $('#tampil').hide()
            $('#tutup').click(function() {
                $('#filter').hide(1000)
                $('#tampil').show(1000)
            })

            $('#tampil').click(function() {
                $('#filter').show(1000)
                $('#tampil').hide()
            })


        })
    </script>
@endpush
