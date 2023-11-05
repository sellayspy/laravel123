@extends('layouts.main')

@section('title')
    Kategori
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Kategori</li>
@endsection

@section('contents')

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
            <button onclick="addForm( '{{ route('kategori.store') }}' )" class="btn btn-success xs btn-flat"><i class="fa fa-plus-circle"></i>Tambah</button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-stiped table-bordered">
                    <thead>
                        <th width="5%">No</th>
                        <th>Kategori</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@includeIf('master.kategori.form')
@endsection

@push('scripts')
    <script>
        let table;

        $(function () {
            table  = $('.table').DataTable({
                processing: true,
                autoWidth:  false,
             ajax: {
                 url: '{{ route('kategori.data') }}',
             },
               columns: [
                {data: 'DT_RowIndex', searchable: false, shortable: false},
                {data: 'nmKategori'},
                {data: 'aksi', searchable: false, shortable: false},
              ]
            });

           $('#modal-form').validator().on('submit',function (e) {
                if (! e.preventDefault()) {
                   $.ajax({
                       url: $('#modal-form form').attr('action'),
                        type: 'post',
                       data: $('#modal-form form').serialize()

                    })
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
            $('#modal-form .modal-title').text('Tambah Kategori');

           $('#modal-form form')[0].reset();
           $('#modal-form form').attr('action',url);
            $('#modal-form [name=_method]').val('post');
            $('#modal-form [name=nmKategori]').focus();
        }

        function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Kategori');

           $('#modal-form form')[0].reset();
           $('#modal-form form').attr('action',url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form [name=nmKategori]').focus();

            $.get(url)
            .done((response) => {
                $('#modal-form [name=nmKategori]').val(response.nmKategori);
            })
            .fail((errors) => {
                alert('tidak dapat menampilkan data');
                return;
            });
        }

        function deleteData(url){
            $.post(url, {
                '_token': '{{ csrf_token() }}'
            })
        }
    </script>
@endpush
