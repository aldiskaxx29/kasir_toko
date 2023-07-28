@extends('templates.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Laporan Keuangan Tahunan</h1>
        </div>
        <div class="section-body">
            {{-- <div class="row">
                <div class="col-md-6"> --}}
            {{-- <form action=""> --}}
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal">
                        @error('tanggal')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-warning">Cari</button>
                </div>
            </div>
            {{-- </form> --}}
            {{-- </div>
                </div> --}}
        </div>
    </section>
@endsection
