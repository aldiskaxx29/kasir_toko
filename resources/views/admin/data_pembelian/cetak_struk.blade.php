<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Cetak Struk</title>
    <style>
        .fixed-table-container {
            border: none; // or border: none !important;
        }

        * {
            padding: 0;
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="" style="width:380px;">
        <div class="text-center border-bottom">
            <img src="./gambar/logo.jpeg" style="width:90px;" class="">
            <div class="text-center"></div>
            <small class="mb-2">Alamat toko: jalan raya mauk km 12 kp. Gintung bambu
                Rt/rw: 12/03
                Kelurahan: Sukadiri
                Kecamatan: Sukadiri</small>
        </div>
        <table class="table" style="font-size:12px;">
            <tr style="height: 10px;">
                <th class="border-0">No</th>
                <td class="text-right border-0">{{ $transaksi->no_order }}</td>
            </tr>
            <tr style="height: 10px;">
                <th class="border-0">Nama Pembeli</th>
                <td class="text-right border-0">{{ $transaksi->nama_pelanggan ?? null }}</td>
            </tr>
            <tr>
                <th class="border-0">Kasir</th>
                <td class="text-right border-0">{{ $transaksi->nama_kasir }}</td>
            </tr>
            <tr>
                <th class="border-0">Tanggal</th>
                <td class="text-right border-0">{{ $transaksi->created_at }}</td>
            </tr>
        </table>

        <table class="table text-right table-striped" style="font-size:12px;">
            <tr>
                <th>Nama Produk</th>
                <th>Qty</th>
                <th>Harga Produk</th>
                <th style="width:100px;">Total Harga</th>
            </tr>
            @foreach ($data as $key => $item)
                <tr>
                    <td style="font-size:14px;">{{ $item->barang->nama_barang }}</td>
                    <td style="font-size:14px;">{{ $item->quantity }}</td>
                    <td style="font-size:14px;">Rp. {{ number_format($hargaSatuan[$key]->harga, 0, ',', '.') }}</td>
                    <td style="font-size:14px;">Rp. {{ number_format($item->sub_total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </table>

        <table class="table text-right">
            <tr>
                <th colspan="2">Harga Total</th>
                <td style="width: 100px;font-size:14px;">Rp. {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                </td>
            </tr>
            <tr>
                <th colspan="2">Pembayaran</th>
                <td style="width: 100px;font-size:14px;">Rp. {{ number_format($transaksi->pembayaran, 0, ',', '.') }}
                </td>
            </tr>
            <tr>
                <th colspan="2">Kembalian</th>
                <td style="width: 120px;font-size:14px;">Rp. {{ number_format($transaksi->kembalian, 0, ',', '.') }}
                </td>
            </tr>
        </table>

        <div class="text-center mt-4">
            <div class="text-center">Terima Kasih</div>
            <small>Silahkan Datang Kembali</small>
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
