<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Cetak Laporan Barang Keluar</title>
  </head>
  <body>
    <div class="text-center">
      <img src="./gambar/logo.jpeg" style="width:90px;" class="">
      <div class="text-center"></div>
      <small class="mb-2">Alamat : jalan raya mauk km 12 kp. Gintung bambu
        Rt/rw: 12/03
        Kelurahan: Sukadiri
        Kecamatan: Sukadiri</small>
        <br>
        <hr>
        <p class="font-weight-bold">Laporan Barang Keluar Pertanggal {{ $dari }} - {{ $sampai }}</p>
     </div>
     <table class="table table-bordered" id="dataTable">
      <thead>
          <tr>
              <th>No</th>
              <th>Tanggal Keluar</th>
              <th>Nama Barang</th>
              <th>Jumlah</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($keluars as $no => $item)
              <tr>
                  <td>{{ $no+1 }}</td>
                  <td>{{ $item->tanggal }}</td>
                  <td>{{ $item->barang->nama_barang }}</td>
                  <td>{{ $item->jumlah }}</td>
              </tr>
          @endforeach
      </tbody>
  </table>

  <table class="table" style="width: 300px;">
    <tr>
      <th>Nama</th>
      <td>Total</td>
    </tr>
    @foreach ($hitung as $h)
    <tr>
      <td>{{ $h->nama }}</td>
      <td>{{ $h->jumlah }}</td>
    </tr>
    @endforeach
  </table>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
  </body>
</html>