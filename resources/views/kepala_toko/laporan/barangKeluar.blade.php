@extends('templates.app')

@section('title', 'Laporan Barang Keluar')

@section('content') 
    <section class="section">
        <div class="section-header">
            <h1>@yield('title')</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
