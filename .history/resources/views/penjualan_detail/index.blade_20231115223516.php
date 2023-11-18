@extends('layouts.main')

@section('title')
   Transaksi Pembelian
@endsection

@push('css')
    <style>
        .tampil-bayar {
            font-size: 5em;
            text-align: center;
            height: 100px;
        }
        .tampil-terbilang {
            padding: 10px;
            background: #f0f0f0;
        }
        .table-pembelian tbody tr:last-child{
            display: none;
        }
        @media(max-width: 768px) {
            .tampil-bayar{
                font-size: 3em;
                height: 70px;
                padding-top: 5px;
            }
        }
    </style>
@endpush

@section('breadcrumb')
    @parent
    <li class="active">Transaksi Penjualan</li>
@endsection

@section('contents')

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">

            <form class="form-produk">
                @csrf

            <div class="form-group row">
                <label for="kode_produk" class="col-lg-2">Kode Produk</label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <input type="hidden" name="id_penjualan" id="id_penjualan" value="{{ $id_penjualan }}">
                        <input type="hidden" name="id_produk" id="id_produk">
                        <input type="text" class="form-control" name="kode_produk" id="kode_produk">
                        <span class="input-group-btn">
                            <button onclick="tampilProduk()" class="btn btn-info btn-flat" type="button"><i class="fa fa-arrow-right"></i></button>
                        </span>
                    </div>
                </div>
            </div>
            </form>

                <table class="table table-stiped table-bordered table-penjualan">
                    <thead>
                        <th width="5%">No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th width="15%">Jumlah</th>
                        <th>Diskon</th>
                        <th>Subtotal</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>

                </table>

                <div class="row">
                    <div class="col-lg-8">
                        <div class="tampil-bayar bg-primary"></div>
                        <div class="tampil-terbilang"></div>
                    </div>
                    <div class="col-lg-4">
                        <form action="{{ route('transaksi.store') }}" class="form-penjualan" method="post">
                            @csrf
                            <input type="hidden" name="id_penjualan" value="{{ $id_penjualan }}">
                            <input type="hidden" name="total" id="total">
                            <input type="hidden" name="totalItem" id="totalItem">
                            <input type="hidden" name="bayar" id="bayar">
                            <input type="hidden" name="id_customer" id="id_customer">


                            <div class="form-group row">
                                <label for="totalrp" class="col-lg-2 control-label">Total</label>
                                <div class="col-lg-8">
                                    <input type="text" name="totalrp" id="totalrp" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kode_member" class="col-lg-2 control-label">Customer</label>
                                <div class="col-lg-8">
                                <div class="input-group">
                                            <input type="text" class="form-control" id="kode_member" name="kode_member">
                                             <span class="input-group-btn">
                                             <button onclick="tampilCustomer()" class="btn btn-info btn-flat" type="button"><i class="fa fa-arrow-right"></i></button>
                                      </span>
                                     </div>
                                  </div>
                            </div>
                            <div class="form-group row">
                                <label for="diskon" class="col-lg-2 control-label">Diskon</label>
                                <div class="col-lg-8">
                                    <input type="number" name="diskon" id="diskon" class="form-control" value="0" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bayar" class="col-lg-2 control-label">Bayar</label>
                                <div class="col-lg-8">
                                    <input type="text" id="bayarrp" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="diterima" class="col-lg-2 control-label">Diterima</label>
                                <div class="col-lg-8">
                                    <input type="text" id="diterima" class="form-control" value="0">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kembali" class="col-lg-2 control-label">Kembali</label>
                                <div class="col-lg-8">
                                    <input type="text" id="kembali" class="form-control" value="0" readonly>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-sm btn-flat pull-right btn-simpan"><i class="fa fa-floppy-o"></i>Simpan Transaksi</button>
            </div>
        </div>
    </div>
</div>
@includeIf('penjualan_detail.produk')
@includeIf('penjualan_detail.customer')
@endsection

@push('scripts')
   <script>
        let table,table2;

        $(function () {
          $('body').addClass('sidebar-collapse');

            table  = $('.table-penjualan').DataTable({
                processing: true,
                autoWidth:  false,
             ajax: {
                 url: '{{ route('transaksi.data',$id_penjualan) }}',
             },
               columns: [
                {data: 'DT_RowIndex', searchable: false, shortable: false},
                {data: 'kode_produk'},
                {data: 'namaProduk'},
                {data: 'hargaJual'},
                {data: 'jumlah'},
                {data: 'diskon'},
                {data: 'subtotal'},
                {data: 'aksi', searchable: false, shortable: false},
              ],
              dom: 'Brt',
              bSort: false,
            })
            .on('draw.dt', function(){
                loadForm($('#diskon').val());
            });
            table2 = $('.table-produk').DataTable();

            $(document).on('input','.quantity',function(){

                let id = $(this).data('id');
                let jumlah = parseInt($(this).val());

                if (jumlah < 1) {
                    $(this).val(1);
                    alert('Jumlah Tidak Boleh Kurang Dari 1');
                    return;
                }

                if (jumlah > 10000) {
                    $(this).val(10000);
                    alert('Jumlah Tidak Boleh Lebih Dari 10000');
                    return;
                }

                $.post(`{{ url('/transaksi') }}/${id}`,{
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'put',
                    'jumlah' : jumlah
                })
                .done(response =>{
                    $(this).on('mouseout', function(){
                        table.ajax.reload();
                    });
                })
                .fail(errors=>{
                    alert('Tidak Dapat Menyimpan Data');
                    return;
                });
            });

            $(document).on('input', '#diskon', function () {
                if ($(this).val() == "") {
                    $(this).val(0).select();
                }

                loadForm($(this).val())
            });
        });

        $('.btn-simpan').on('click', function(){
                $('.form-penjualan').submit();
            });


        function tampilProduk() {
            $('#modal-produk').modal('show');
        }

        function hideProduk() {
            $('#modal-produk').modal('hide');
        }

        function pilihProduk(id,kode){
            $('#id_produk').val(id);
            $('#kode_produk').val(kode);
            hideProduk();
            tambahProduk();
        }

        function tambahProduk(){
            $.post('{{ route('transaksi.store') }}', $('.form-produk').serialize())
            .done(response => {
                $('#kode_produk').focus();
                table.ajax.reload();
            })
            .fail(errors => {
                alert('Tidak Dapat Menyimpan Data');
                return;
            });
        }

        function tampilCustomer()
        {
            $('#modal-customer').modal('show');
        }

        function hideCustomer()
        {
            $('#modal-customer').modal('hide');
        }

        function pilihCustomer(id,kode)
        {
            $('#id_customer').val(id);
            $('#kode_member').val(kode);
            hideCustomer();
            tambahCustomer();
        }

        function deleteData(url){
        if (confirm('Yakin Mau Mengapus Data Ini')) {
            $.post(url, {
                '_token': $('[name=csrf-token]').attr('content'),
                '_method': 'delete'
            })
            .done((response)=> {
                table.ajax.reload();
            })
            .fail((errors) =>{
                alert('tidak dapat menghapus data');
                return;
            })
        }
        }

        function loadForm(diskon = 0) {
            $('#total').val($('.total').text());
            $('#totalItem').val($('.totalItem').text());

            $.get(`{{ url('/transaksi/loadform') }}/${diskon}/${$('.total').text()}/${0}`)

            .done(response =>{
                $('#totalrp').val('Rp. '+ response.totalrp);
                $('#bayarrp').val('Rp. '+ response.bayarrp);
                $('#bayar').val(response.bayar);
                $('.tampil-bayar').text('Rp. '+ response.bayarrp);
                $('.tampil-terbilang').text('Rp. '+ response.terbilang);
            })
            .fail(errors =>{
                alert('Tidak Dapat Menyimpan Data');
                return;
            })
        }
    </script>
@endpush
