@extends('layouts.main')

@section('title')
    Transaksi Pembelian
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Pembelian</li>
@endsection

@section('contents')

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
           <table>
            <tr>
                <td>Suplier</td>
                <td>: {{ $suplier->namaSuplier }} </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{ $suplier->alamat }} </td>
            </tr>
            <tr>
                <td>Telepon</td>
                <td>: {{ $suplier->noTelepon }} </td>
            </tr>
           </table>
            </div>
            <div class="box-body table-responsive">


           <div class="form-group row">
           <label for="kodeProduk" class="col-lg-2">Kode Produk</label>
           <div class="col-lg-5">
                    <div class="input-group">
                        <input type="hidden" name="id_produk" id="id_produk">
                    <input type="text" class="form-control" name="kodeProduk" id="kodeProduk">
                    <span class="input-group-btn">
                        <button onclick="tampilProduk()" class="btn btn-info btn-flat" type="button"><i class="fa fa-arrow-right"></i></button>
                    </span>
                    </div>

                </div>
           </div>

                <table class="table table-stiped table-bordered">
                    <thead>
                        <th width="5%">No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Jumalah</th>
                        <th>SubTotal</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>

                </table>
            </div>
        </div>
    </div>
</div>
@includeIf('pembelian_detail.produk')
@endsection

@push('scripts')
    <script>
        let table;

        $(function () {
            table  = $('.table').DataTable({
             /*   processing: true,
                autoWidth:  false,
             ajax: {
                 url: '{{ route('suplier.data') }}',
             },
               columns: [
                {data: 'DT_RowIndex', searchable: false, shortable: false},
                {data: 'namaSuplier'},
                {data: 'alamat'},
                {data: 'noTelepon'},
                {data: 'aksi', searchable: false, shortable: false},
              ] */
            });


        });

        function tampilProduk() {
            $('#modal-produk').modal('show');
        }

        function hideProduk() {
            $('#modal-produk').modal('show');
        }

       function pilihProduk(id,kode){
        $('#id_produk').val(id);
        $('kodeProduk').val(kode);
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
    </script>
@endpush
