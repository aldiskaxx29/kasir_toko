@extends('templates.app')

@section('title', 'Data Barang')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Barang</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body" style="overflow-x:scroll;">
                    @if (session('data_barang'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('data_barang') }}
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
                                <th>Nama Barang</th>
                                <th>Stok</th>
                                <th>Harga Jual Pcs</th>
                                <th>Harga Jual Dus</th>
                                <th>Harga Jual Slop</th>
                                <th>Harga Modal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($barang) != 0)
                                @foreach ($barang as $no => $item)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td class="text-capitalize">{{ $item->nama_barang }}</td>
                                        <td>{{ $item->stok }}</td>
                                        <td>
                                            @if (!$item->harga_pcs)
                                                -
                                            @else
                                                Rp. {{ number_format($item->harga_pcs, 0, ',', '.') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (!$item->harga_dus)
                                                -
                                            @else
                                                Rp. {{ number_format($item->harga_dus, 0, ',', '.') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (!$item->harga_slop)
                                                -
                                            @else
                                                Rp. {{ number_format($item->harga_slop, 0, ',', '.') }}
                                            @endif
                                        </td>
                                        <td>
                                            Rp. {{ number_format($item->harga_modal) }}
                                        </td>
                                        <td>
                                            <form action="{{ route('data-barang.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <a href="#" class="btn btn-warning btn-sm" data-toggle="modal"
                                                    data-target="#modalDetail{{ $item->id }}"><i
                                                        class="fas fa-eye"></i></a>
                                                <a href="#" data-toggle="modal"
                                                    data-target="#modalEdit{{ $item->id }}"
                                                    class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin di hapus?')"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                        {{-- <td>
                                            <button class="btn btn-sm btn-success" data-toggle="modal"
                                                data-target="#exampleModalCenter{{ $item->id }}">Barcode</button>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9">
                                        <div class="alert alert-danger">Data Tidak Ada</div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview')
            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
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
                    <form action="{{ route('data-barang.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Barang</label>
                            <input type="text" class="form-control" placeholder="Nama Barang" name="nama_barang"
                                id="nama_barang">
                            @error('nama_barang')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Stok</label>
                            <input type="number" class="form-control" name="stok" placeholder="Masukan Stok">
                            @error('stok')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Harga Pcs</label>
                            <input type="number" class="form-control" name="harga_pcs" placeholder="Masukan Harga Pcs">
                            @error('harga_pcs')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Harga Dus</label>
                            <input type="number" class="form-control" name="harga_dus" placeholder="Masukan Harga Dus">
                            @error('harga_dus')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Harga Slop</label>
                            <input type="number" class="form-control" name="harga_slop" placeholder="Masukan Harga Slop">
                            @error('harga_slop')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Harga Modal</label>
                            <input type="number" class="form-control" name="harga_modal" placeholder="Masukan Harga Modal">
                            @error('harga_modal')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                            <label for="">Foto Produk</label>
                            <img class="img-preview" width="50%" alt="">
                            <input type="file" class="form-control" name="foto_produk" onchange="previewImage()"
                                id="image">
                            @error('foto_produk')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div> --}}
                        <div class="float-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-warning">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Ubah --}}
    @foreach ($barang as $item)
        <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="overflow-y:auto;">
                        <form action="{{ route('data-barang.update', $item->id) }}" method="post"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div class="form-group">
                                <label for="">Nama Barang</label>
                                <input type="text" class="form-control" placeholder="Nama Barang" name="nama_barang"
                                    value="{{ $item->nama_barang }}">
                                @error('nama_barang')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Stok</label>
                                <input type="number" class="form-control" name="stok" value="{{ $item->stok }}">
                                @error('stok')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Harga Psc</label>
                                <input type="number" class="form-control" name="harga_pcs"
                                    placeholder="Masukan Harga Pcs" value="{{ $item->harga_pcs }}">
                                @error('harga_pcs')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Harga Dus</label>
                                <input type="number" class="form-control" name="harga_dus"
                                    placeholder="Masukan Harga Dus" value="{{ $item->harga_dus }}">
                                @error('harga_pcs')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Harga Slop</label>
                                <input type="number" class="form-control" name="harga_slop"
                                    placeholder="Masukan Harga Slop" value="{{ $item->harga_slop }}">
                                @error('harga_dus')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            {{-- <div class="form-group">
                                <label for="">Foto Produk</label>
                                @if ($item->foto_produk)
                                    <img src="{{ url('storage/' . $item->foto_produk) }}" alt=""
                                        class="img-preview img-fluid mb-3 col-sm-5 d-block">
                                @else
                                    <img class="img-preview img-fluid mb-3 col-sm-5" alt="">
                                @endif
                                <input type="hidden" class="form-control" name="oldImage"
                                    value="{{ $item->foto_produk }}">
                                <input type="file" class="form-control" name="foto_produk"
                                    value="{{ $item->foto_produk }}" onchange="previewImage()" id="image">
                                @error('foto_produk')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div> --}}

                            <div class="float-right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-warning">Save</button>
                            </div>
                            {{-- <div style="height: 20px"></div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Modal Detail --}}
    @foreach ($barang as $item)
        <div class="modal fade bd-example-modal-lg" id="modalDetail{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Detail Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                {{-- <div class="col-4">
                                    <img src="{{ url('storage', $item->foto_produk) }}" alt="" class="w-100">
                                </div> --}}
                                <div class="col">
                                    <table class="table">
                                        <tr>
                                            <th>Nama barang</th>
                                            <td>{{ $item->nama_barang }}</td>
                                        </tr>
                                        <tr>
                                            <th>Stok</th>
                                            <td>{{ $item->stok }}</td>
                                        </tr>
                                        <tr>
                                            <th>Harga Pcs</th>
                                            @if ($item->harga_pcs)
                                                <td>Rp. {{ number_format($item->harga_pcs, 0, ',', '.') }}</td>
                                            @else
                                                <td>-</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <th>Harga Dus</th>
                                            @if ($item->harga_dus)
                                                <td>Rp. {{ number_format($item->harga_dus, 0, ',', '.') }}</td>
                                            @else
                                                <td>-</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <th>Harga Slop</th>
                                            @if ($item->harga_slop)
                                                <td>Rp. {{ number_format($item->harga_slop, 0, ',', '.') }}</td>
                                            @else
                                                <td>-</td>
                                            @endif
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Modal Barcode --}}
    {{-- @foreach ($barang as $item)
        <div class="modal fade" id="exampleModalCenter{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="visible-print text-center">
                            {!! QrCode::size(200)->generate($item->nama_barang . $item->stok . $item->harga) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach --}}

@endpush
