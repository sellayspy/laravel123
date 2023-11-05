@extends('layouts.main')

@section('title')
    Data Barang
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Barangi</li>
@endsection

@section('contents')

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
            <button onclick="addForm( '{{ route('barang.store') }}' )" class="btn btn-success xs btn-flat"><i class="fa fa-plus-circle"></i>Tambah</button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-stiped table-bordered">
                    <thead>
                        <th width="5%">No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th>Harga_Satuan</th>
                        <th>Stock</th>
                        <th>Tanggal_Expired</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>

                </table>
            </div>
        </div>
    </div>
</div>
@includeIf('master.barang.form')
@endsection

@push('scripts')
    <script>
        let table;

        $(function () {
            table  = $('.table').DataTable({
                processing: true,
                autoWidth:  false,
             ajax: {
                 url: '{{ route('barangs.data') }}',
             },
               columns: [
                {data: 'DT_RowIndex', searchable: false, shortable: false},
                {data: 'kdBarang'},
                {data: 'nmBarang'},
                {data: 'kategori'},
                {data: 'satuan'},
                {data: 'hargaSatuan'},
                {data: 'stock'},
                {data: 'tglExpired'},
                {data: 'aksi', searchable: false, shortable: false},
              ]
            });

           $('#modal-form').validator().on('submit',function (e) {
                if (! e.preventDefault()) {
                   $.post($('#modal-form form').attr('action'),$('#modal-form form').serialize())
                    .done((response)=> {
                        $('modal-form').modal('hide');
                       table.ajax.reload();
                   })
                    .fail((errors) => {
                        alert('Tidak Dapat Menyimpan data');
                        return;
                   });
               }
            })

        });

        function addForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah Barang');

           $('#modal-form form')[0].reset();
           $('#modal-form form').attr('action',url);
            $('#modal-form [name=_method]').val('post');
            $('#modal-form [name=nmBarang]').focus();
        }

        function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Barang');

           $('#modal-form form')[0].reset();
           $('#modal-form form').attr('action',url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form [name=nmBarang]').focus();

            $.get(url)
            .done((response) => {
                $('#modal-form [name=nmBarang]').val(response.nmBarang);
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
