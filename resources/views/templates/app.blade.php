<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('gambar/logo.jpeg') }}">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap4.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/components.css">

    <style>
        .selects{
            /* height: 150px; */
            /* overflow-x: 'auto'; */
        }
    </style>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg bg-danger"></div>
            @include('templates.topbar')

            @include('templates.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>
            <footer class="main-footer">
                {{-- <div class="footer-left">
                    Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad
                        Nauval Azhar</a>
                </div>
                <div class="footer-right">
                    2.3.0
                </div> --}}
            </footer>
        </div>
    </div>
    @stack('addon-modal')
    @stack('add-script')

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="../assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap4.min.js"></script>
    

    <!-- Template JS File -->
    <script src="../assets/js/scripts.js"></script>

    <!-- Page Specific JS File -->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();

            // $('.barangs_id').on('change', (event) => {
            //     getBarang(event.target.value).then(barang => {
            //         $('.harga_satuan').val(barang.harga).change()
            //     })
            // });

            // async function getBarang(id){
            //     let response = await fetch('/api/produk/' + id)
            //     let data = await response.json();
            //     console.log(data)
            //     return data;
            // }
        })

        // $(document).on('change', '.qty', function(e) {
        //     e.preventDefault();
        //     let El = $(this).parent().parent();
        //     calculationPrice(El)
        // })

        // function calculationPrice(El){
        //     let qty = $(El.find('.qty')).val();
        //     console.log('qty',qty)
        // }

        function changeBarang(a) {
            getBarang(event.target.value, a).then(barang => {
                console.log('apaan', barang)
                console.log('a', a)
                
                // $('.harga_satuan'+a).val(barang.harga).change()
            })
        }

        async function getBarang(id, i){
            let response = await fetch('/api/produk/' + id)
            let data = await response.json();
            // console.log(data)
            // console.log(data.id)
            let satuans = await fetch('/api/barang-satuan/' + data.id)
            let data1 = await satuans.json();
            console.log('satuan ni', data1)
            $('.satuans'+i).html("");
            data1.forEach(satuan => {
                // console.log('ada',satuan.harga)
                $('.satuans'+i).append(`<option value="${satuan.harga}">${satuan.satuan.satuan} Rp. ${satuan.harga}</option>`)
                // $('.harga_satuan');
            });
            return data;
        }

        // function changeBarang(a) {
        //     getBarang(event.target.value).then(barang => {
        //         $('.harga_satuan'+a).val(barang.harga).change()
        //     })
        // }

        // async function getBarang(id){
        //     let response = await fetch('/api/produk/' + id)
        //     let data = await response.json();
        //     console.log(data)
        //     console.log(data.id)
        //     let satuans = await fetch('/api/barang-satuan/' + data.id)
        //     let data1 = await satuans.json();
        //     console.log('satuan ni', data1)
            
        //     data1.forEach(satuan => {
        //         // console.log('ada',satuan.harga)
        //         $('#satuans').append(`<option value="">${satuan.satuan.satuan} Rp. ${satuan.harga}</option>`)
        //     });
        //     return data;
        // }

        function calculateHarga(i) {
            var qty = $('.qty'+i).val();
            var satuan = $('.satuans'+i).find("option").filter(":selected").val();;

            var harga_satuan = qty * satuan;

            $('#harga_satuan'+i).val(harga_satuan);
        }

        $(document).ready(function() {
            $('#calculate_total_harga').click(function() {
                var total_harga = 0;
                
                $('.harga_satuan').each(function() {
                    total_harga += +$(this).val();
                });
                
                $('#total_harga').val(total_harga);
            })
        })

    </script>
    
    @stack('addon-script')

    {{-- <script>
        var path = "{{ url('typhead_autocomplit/action') }}";

        $('#barang_name').typeahead({
            alert('p')
            // source: function(query, process){
            //     return $.get(path, {query:query}, function(data){
            //         return process(data)
            //     })
            // }

        });
    </script> --}}
</body>

</html>
