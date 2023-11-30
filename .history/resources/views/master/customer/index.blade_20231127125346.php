@extends('layouts.main')

@section('title')
    Customer
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Customer</li>
@endsection

@section('contents')

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
            <button onclick="addForm( '{{ route('customer.store') }}' )" class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus-circle"></i>Tambah</button>
            <button onclick="cetakCustomer('{{ route('customer.cetak_customer') }}')" class="btn btn-info btn-xs btn-flat"><i class="fa fa-id-card"></i>Cetak Member</button>
            </div>
            <div class="box-body table-responsive">
            <form action="" method="post" class="form-produk">
                    @csrf
                <table class="table table-stiped table-bordered">
                    <thead>
                    <th>
                            <input type="checkbox" name="select_all" id="select_all">
                        </th>
                        <th width="5%">No</th>
                        <th>Kategori</th>
                        <th>Kode</th>
                        <th>No Telepon</th>
                        <th>Alamat</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>
                </table>
            </form>
            </div>
        </div>
    </div>
</div>
@includeIf('master.customer.form')
@endsection

@push('scripts')
    <script>
        let table;

        $(function () {
            $('body').addClass('sidebar-collapse');

            table  = $('.table').DataTable({
                processing: true,
                autoWidth:  false,
             ajax: {
                 url: '{{ route('customer.data') }}',
             },
               columns: [
                {data: 'select_all', searchable: false, shortable: false},
                {data: 'DT_RowIndex', searchable: false, shortable: false},
                {data: 'kode_member'},
                {data: 'namaCustomer'},
                {data: 'noTelepon'},
                {data: 'alamat'},
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
            });

            $('[name=select_all]').on('click', function () {
                $('checkbox').prop('checked', this.checked);
            });

        });

        function addForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah Customer');

           $('#modal-form form')[0].reset();
           $('#modal-form form').attr('action',url);
            $('#modal-form [name=_method]').val('post');
            $('#modal-form [name=namaCustomer]').focus();
        }

        function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Customer');

           $('#modal-form form')[0].reset();
           $('#modal-form form').attr('action',url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form [name=namaCustomer]').focus();

            $.get(url)
            .done((response) => {
                $('#modal-form [name=namaCustomer]').val(response.namaCustomer);
                $('#modal-form [name=noTelepon]').val(response.noTelepon);
                $('#modal-form [name=alamat]').val(response.alamat);
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

        function cetakCustomer(){

        }
    </script>
@endpush
