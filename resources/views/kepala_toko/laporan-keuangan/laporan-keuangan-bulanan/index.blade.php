@extends('templates.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Laporan Keuangan Bulanan</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('laporan.keuangan.bulanan.action') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Bulan Awal</label>
                                    <input type="month" class="form-control" name="bulan">
                                    @error('bulan')
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
