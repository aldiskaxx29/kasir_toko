@extends('templates.app')

@section('title', 'Data Kategori')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Satuan</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body" style="overflow-x:scroll;">
                    @if (session('satuan'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('satuan') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                    @endif
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i
                            class="fas fa-plus"></i>
                        Tambah Data</a>
                    <hr>
                    <table class="table table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Satuan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($satuan as $no => $item)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $item->satuan }}</td>
                                    <td>
                                        <form action="{{ url('hapusKategoriBarang') }}/{{ $item->id }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="#" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#exampleModal{{ $item->id }}"><i
                                                    class="fas fa-edit"></i></a>
                                            <button onclick="return confirm('Yakin ingin di hapus?')" type="submit"
                                                class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        <div class="alert alert-danger">Data Tidak Ada</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('addon-modal')
    <!-- Modal Tambah-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('data-satuan.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Satuan</label>
                            <input type="text" class="form-control" placeholder="Nama Satuan" name="satuan">
                            @error('satuan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="float-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-warning">Save</button>
                        </div>
                        <div style="height: 20px"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ubah-->
    @foreach ($satuan as $item)
        <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('data-satuan.update', $item->id) }}/{{ $item->id }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="">Nama Kategori</label>
                                <input type="text" class="form-control" value="{{ $item->satuan }}" name="satuan">
                                @error('satuan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="float-right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-warning">Save</button>
                            </div>
                            <div style="height: 20px"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endpush
