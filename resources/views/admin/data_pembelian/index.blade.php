@extends('templates.app')

@section('title', 'Data Pembelian')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Pembelian</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body" style="overflow-x:scroll;">
                    @if (session('data-pembelian'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('data-pembelian') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                    @elseif (session('pembelian_error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">{{ session('pembelian_error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                    @endif
                    <a href="{{ route('data-pembelian.create') }}" class="btn btn-primary" ><i
                            class="fas fa-plus"></i>
                        Tambah Data</a>
                    <hr>
                    <div style="overflow-x: auto;">
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th style="width: 130px;">No Pembelian</th>
                                    <th>Nama Kasir</th>
                                    {{-- <th style="width:100px;">Nama Barang</th>
                                    <th>Satuan</th> --}}
                                    <th>Quantity</th>
                                    {{-- <th style="width:100px;">Harga Satuan</th> --}}
                                    <th style="width:100px;">Total Harga</th>
                                    <th>Pembayaran</th>
                                    <th>Kembalian</th>
                                    <th style="width:100px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pembelian as $no => $item)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $item->no_order }}</td>
                                        <td>{{ $item->nama_kasir }}</td>
                                        {{-- <td>{{ $item->barang->nama_barang }}</td> --}}
                                        {{-- <td>{{ $item->satuan->satuan }}</td> --}}
                                        <td>{{ $item->total_produk }}</td>
                                        {{-- <td>Rp. {{ number_format($item->harga_satuan,0,',','.') }}</td> --}}
                                        <td>Rp. {{ number_format($item->total_harga,0,',','.') }}</td>
                                        <td>Rp. {{ number_format( $item->pembayaran,0,',','.') }}</td>
                                        <td>Rp. {{ number_format($item->kembalian,0,',','.') }}</td>
                                        <td style="width:100px;">
                                            <form action="{{ route('data-pembelian.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <a href="{{ route('cetak_struk', $item->id) }}" target="_blank" class="btn btn-warning btn-sm"><i class="fas fa-print"></i></a>
                                                {{-- <a href="#" class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#exampleModal{{ $item->id }}"><i class="fas fa-edit"></i></a> --}}
                                                <button onclick="return confirm('Yakin ingin di hapus?')" type="submit"
                                                    class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10">
                                            <div class="alert alert-danger">Data Tidak Ada</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('addon-modal')
    <!-- Modal Tambah-->
    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('data-pembelian.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Barang</label>
                            <select name="barangs_id" class="form-control" id="barangs_id">
                                <option value="">-- PIlihan --</option>
                                @foreach ($barang as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                                    @endforeach
                                </select>
                            @error('barangs_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Quantity</label>
                            <input type="text" class="form-control" placeholder="Jumlah" name="quantity">
                            @error('quantity')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Satuan</label>
                            <select name="satuan_id" class="form-control" id="">
                                <option value="">-- Pilihan --</option>
                                @foreach ($satuans as $satuan)
                                    <option value="{{ $satuan->id }}">{{ $satuan->satuan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Harga Satuan</label>
                            <input type="text" name="harga_satuan" class="form-control" id="harga_satuan" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Pembayaran</label>
                            <input type="number" class="form-control" name="pembayaran">
                            @error('pembayaran')
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
    </div> --}}

    <!-- Modal Ubah-->
    {{-- @foreach ($pembelian as $item)
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
                    <div class="modal-body" style="overflow-y: auto; height:400px;">
                        <form action="{{ route('data-pembelian.update', $item->id) }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="">Nama Barang</label>
                                <select name="barangs_id" class="form-control" id="barangs_id">
                                    @foreach ($barang as $b)
                                        <option value="{{ $b->id }}" {{ $b->id === $item->barangs_id ? 'selected' : '' }}>{{ $b->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                @error('barangs_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Quantity</label>
                                <input type="text" class="form-control" placeholder="Jumlah" name="quantity" value="{{ $item->quantity }}">
                                @error('quantity')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Satuan</label>
                                <select name="satuan_id" class="form-control" id="">
                                    @foreach ($satuans as $satuan)
                                        <option value="{{ $satuan->id }}" {{ $satuan->id === $item->satuan_id ? 'selected' : '' }}>{{ $satuan->satuan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Harga Satuan</label>
                                <input type="text" name="harga_satuan" class="form-control" id="harga_satuan" value="{{ $item->harga_satuan }}">
                            </div>
                            <div class="form-group">
                                <label for="">Total Harga</label>
                                <input type="number" class="form-control" name="total_harga" value="{{ $item->total_harga }}">
                                @error('total_harga')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Pembayaran</label>
                                <input type="number" class="form-control" name="pembayaran" value="{{ $item->pembayaran }}">
                                @error('pembayaran')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Kembalian</label>
                                <input type="number" class="form-control" name="kembalian" value="{{ $item->kembalian }}">
                                @error('kembalian')
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
    @endforeach --}}




{{-- <script>
    $(document).ready(function(){
        
    })
</script> --}}

@endpush