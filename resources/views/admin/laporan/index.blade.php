@extends('templates.app')

@section('title', 'Data Laporan')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>@yield('title')</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Laporan Pembelian</h3>
                </div>
                <div class="card-body">
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
</section>
@endsection
