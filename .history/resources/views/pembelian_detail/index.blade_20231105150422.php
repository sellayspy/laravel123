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
           <div class="row">
           <div class="col-lg-5">
           <div class="form-group">
                    <div class="input-group">
                    <label for="kodeProduk">Kode Produk</label>
                    <input type="text" class="form-control" name="kodeProduk" id="kodeProduk">
                    <span class="input-group-btn">
                        <button class="btn btn-info btn-flat" type="button"><i class="fa fa-arr-info btn-flat"></i></button>
                    </span>
                    </div>

                </div>
           </div>
           </div>

                <table class="table table-stiped table-bordered">
                    <thead>
                        <th width="5%">No</th>
                        <th>Tanggal</th>
                        <th>Suplier</th>
                        <th>Total Item</th>
                        <th>Total Harga</th>
                        <th>Diskon</th>
                        <th>Total Bayar</th>
                        <th>No Telepon</th>
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

        function addForm() {
            $('#modal-suplier').modal('show');
        }

        function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Suplier');

           $('#modal-form form')[0].reset();
           $('#modal-form form').attr('action',url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form [name=namaSuplier]').focus();

            $.get(url)
            .done((response) => {
                $('#modal-form [name=namaSuplier]').val(response.namaSuplier  );
                $('#modal-form [name=alamat]').val(response.alamat  );
                $('#modal-form [name=noTelepon]').val(response.noTelepon  );
            })
            .fail((errors) => {
                alert('tidak dapat menampilkan data');
                return;
            });
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
