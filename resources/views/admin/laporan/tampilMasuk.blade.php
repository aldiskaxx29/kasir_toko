@extends('template-admin.app')

@section('title', 'Filter Laporan')

@section('content')
    <div class="row" id="filter">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('filterMasuk') }}" method="post">
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
                    <hr>
                    <table class="table tabl-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Tanggal Masuk</th>
                                <th>Jumlah</th>
                                <th>Total Harga</th>
                                <th>SUpplier</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($laporan) == 0)
                                <div class="alert alert-danger">Data Kosong</div>
                            @else
                                @foreach ($laporan as $no => $item)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $item->nama_barang }}</td>
                                        <td>{{ $item->kategori }}</td>
                                        <td>{{ $item->tanggal_masuk }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>{{ $item->total_harga }}</td>
                                        <td>{{ $item->supplier }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

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
