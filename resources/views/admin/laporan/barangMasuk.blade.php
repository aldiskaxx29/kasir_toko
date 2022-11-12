@extends('template-admin.app')

@section('title', 'Laporan Barang Masuk')

@section('content')
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
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
