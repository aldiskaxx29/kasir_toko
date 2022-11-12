@extends('templates.app')

@section('title', 'Dashboard')

@section('content')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Nama', 'Qty'],
          <?php 
          echo $diagram
          
          ?>
        ]);

        var options = {
          title: 'Data Pembelian'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

    <section class="section"> 
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="far fa-user"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Data Barang</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $dataBarang }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-info">
                                    <i class="far fa-newspaper"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Barang Masuk</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $barangMasuk }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-warning">
                                    <i class="far fa-file"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Barang Keluar</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $barangKeluar }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-secondary">
                                    <i class="fas fa-circle"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>User</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $user }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6 col">
                            <div id="piechart" style="width: 100%; height: 500px;"></div>
                        </div>
                        <div class="col-md-6">
                            <h4>Data Bulan Ini</h4>
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Order</th>
                                        <th>Total Produk</th>
                                        <th>Total Harga</th>    
                                    </tr> 
                                </thead>
                                <tbody>
                                    @foreach ($data as $no => $d)
                                        <tr>
                                            <td>{{ $no+1 }}</td>
                                            <td>{{ $d->no_order }}</td>    
                                            <td>{{ $d->total_produk }}</td>    
                                            <td>Rp. {{ number_format($d->total_harga,0,',','.') }}</td>    
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h4>Data Bulan Ini</h4>
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Data</th>
                                        <th>No Order</th>
                                        <th>Bulan</th>   
                                    </tr> 
                                </thead>
                                <tbody>
                                    @foreach ($p as $no => $a)
                                        <tr>
                                            <td>{{ $no+1 }}</td>
                                            <td>{{ $a->data }}</td>    
                                            <td>{{ $a->year }}</td>    
                                            <td>{{ Carbon\Carbon::parse(11)->format('m') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
