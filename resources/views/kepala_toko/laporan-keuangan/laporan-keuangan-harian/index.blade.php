@extends('templates.app')

@section('title', 'Laporan Keuangan Harian')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Laporan Keuangan Harian</h1>
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
        </div>
    </section>
@endsection
