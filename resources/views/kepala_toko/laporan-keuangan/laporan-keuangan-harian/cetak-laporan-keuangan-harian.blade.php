<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Cetak Laporan</title>

</head>

<body>
    <div class="">
        <div class="row">
            <div class="col">
                <div class="text-center">

                    <img src="./gambar/logo.jpeg" style="width:90px;" class="">
                    <div class="font-bold text-center py-4">Larporan Keuangan Harian Per Tanggal {{ $tanggal }}
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <table class="table" style="font-size:11px;" id='dataTable'>
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>No Order</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Total Produk</th>
                                    <th>Harga Satuan</th>
                                    <th>Total Harga</th>
                                    <th>Pembayaran</th>
                                    <th>Harga Modal</th>
                                    <th>Keuntungan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $key => $item)
                                    <tr>
                                        <td style="font-size:8px;">{{ $item->created_at }}</td>
                                        <td style="font-size:8px;">{{ $item->transaksi->no_order }}</td>
                                        <td>{{ $item->transaksi->nama_pelanggan }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>Rp. {{ number_format($perSatuans[$key]->harga, 0, ',', '.') }}</td>
                                        <td>Rp. {{ number_format($item->sub_total, 0, ',', '.') }}</td>
                                        <td>Rp. {{ number_format($item->transaksi->pembayaran, 0, ',', '.') }}</td>
                                        <td>Rp.{{ number_format($item->barang->harga_modal, 0, ',', '.') }}
                                        </td>
                                        <td>Rp.
                                            {{ number_format($keuntungan[$key], 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">Data Tidak Di Temukan</div>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table">
                                    <tr>
                                        <th>Total Keuntungan</th>
                                        <th>Rp. {{ number_format($totalKeuntungan, 0, ',', '.') }}</th>
                                    </tr>
                                    <tr>
                                        <th>Total Pelanggan</th>
                                        <th>{{ count($transaksi) }}</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="text-center mt-4">
            <div class="text-center">TOKO ARI</div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
</body>

</html>
