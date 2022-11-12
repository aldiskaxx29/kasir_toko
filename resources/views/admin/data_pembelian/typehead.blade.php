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
                    <form action="{{ route('data-pembelian.store') }}" method="post">
                      @csrf
                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group">
                              <label for="">Nama Barang </label>
                              <input type="text" class="form-control barang_name" name="barang_name[]"  id="barang_name" onchange="changeBarang(0);">
                                {{-- <select name="barangs_id[]" class="form-control barangs_id" onchange="changeBarang(0);" >
                                    <option value="">-- Pilihan --</option>
                                    @foreach ($barang as $item)
                                      <option value="{{ $item->id }}" >{{ $item->nama_barang }}</option>
                                    @endforeach
                                </select> --}}
                              @error('barangs_id')
                                  <small class="text-danger">{{ $message }}</small>
                              @enderror
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                              <label for="">Quantity</label>
                              <input type="number" class="form-control" placeholder="Jumlah" name="quantity[]">
                              @error('quantity')
                                  <small class="text-danger">{{ $message }}</small>
                              @enderror
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                              <label for="">Satuan</label>
                              <select name="satuan_id[]" class="form-control" id="">
                                  <option value="">-- Pilihan --</option>
                                  @foreach ($satuans as $satuan)
                                      <option value="{{ $satuan->id }}">{{ $satuan->satuan }}</option>
                                  @endforeach
                              </select>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                              <label for="">Harga Satuan</label>
                              {{-- <input type="number" name="harga[]" class="form-control harga_satuan0" readonly> --}}
                              <input type="number" name="harga[]" class="form-control harga_satuan" readonly>
                          </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <br>
                                <button id="new-form" type="button" class="btn btn-success btn-sm mb-2 form-control mt-2"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                      </div>
                      <div id="add-form"></div>
                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group">
                              <label for="">Pembayaran</label>
                              <input type="number" class="form-control" name="pembayaran">
                              @error('pembayaran')
                                  <small class="text-danger">{{ $message }}</small>
                              @enderror
                          </div> 
                        </div>
                      </div>

                      <div class="float-left">
                          <a href="{{ route('data-pembelian.index') }}" class="btn btn-secondary">Close</a>
                          <button type="submit" class="btn btn-warning">Save</button>
                      </div>
                      <div style="height: 20px"></div>
                  </form>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('add-script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript">
    // add row
    var i = 1;
    $("#new-form").click(function() {
        var html = '';
        html +=
            `<div class="row hapusRow">
              <div class="col-md-3">
                <div class="form-group">
                    <label for="">Nama Barang</label>
                    <input type="text" class="form-control barang_name" name="barang_name" id="">
                    @error('barangs_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                    <label for="">Quantity</label>
                    <input type="text" class="form-control" placeholder="Jumlah" name="quantity[]">
                    @error('quantity')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                    <label for="">Satuan</label>
                    <select name="satuan_id[]" class="form-control" id="">
                        <option value="">-- Pilihan --</option>
                        @foreach ($satuans as $satuan)
                            <option value="{{ $satuan->id }}">{{ $satuan->satuan }}</option>
                        @endforeach
                    </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                    <label for="">Harga Satuan</label>
                    <input type="text" name="harga[]" class="form-control harga_satuan`+ i + `" readonly>
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                    <br>
                    <button id="delete-form" type="button" class="btn btn-danger btn-sm mb-2 deleteRow form-control mt-2"><i class="fas fa-trash"></i></button>      
                </div>
              </div>
            </div>
            `;

        $('#add-form').append(html);
        i++;
    });

    // remove row
    $(document).on('click', '.deleteRow', function() {
        $(this).closest('.hapusRow').remove();
    });
</script>

<script>
// $(document).ready(function() {
        // $('.barangs_id').change(function() {
        //     let data = $(this).find(':selected').data("barang");
        //     $('.harga_satuan').val(data.harga);
        // });
        
        var path = "{{ url('typhead_autocomplit/action') }}";

    $('#barang_name').typeahead({
        source: function(query, process){
            return $.get(path, {query:query}, function(data){
                return process(data)
            })
        }

    });

    // $('.barang_name').typeahead({
    //     source: function(query, process){
    //         return $.get(path, {query:query}, function(data){
    //             console.log(data)
                
    //             return process(data)
    //             // data.forEach(element => {
    //             //     // $("#auto-complete").autocomplete({
    //             //     //     source: element.data
    //             //     // });
    //             //     // console.log('ada',element.data)

    //             //     $('.barang_name').select(element.data)
    //             //     $('.harga_satuan').val(element.harga)
    //             // });
    //         })

    //     }

    // });
    // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
    // $(document).ready(function(){
    //     $('.barang_name').autocomplete({
    //         source: function(request, response){
    //             $.ajax({
    //                 url: '{{ route('typhead_autocomplit.action') }}',
    //                 type: 'post',
    //                 dataType: 'json',
    //                 data : {
    //                     _token: CSRF_TOKEN,
    //                     search: request.term
    //                 },
    //                 success: function(data){
    //                     response(data)
    //                 }
    //             });
    //         },
    //         select: function(event, ui){
    //             $('.barang_name').val(ui.item.barang);
    //             $('.harga_satuan').val(ui.item.harga);
    //             return false
    //         }
    //     })
    // })
// });
</script>
@endpush