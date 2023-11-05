@extends('layouts.main')

@section('contents')

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
            <button onclick="addForm('{{ route('kategoris.store') }}')" class="btn btn-success xs btn-flat"><i class="fa fa-plus-circle"></i>Tambah</button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-stiped table-bordered">
                    <thead>
                        <th width="5%">No</th>
                        <th>Kategori</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>
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
               // ajax: {
                   // url: '{{ route('kategori.data') }}',
             //   }
            });

            $('#modal-from').validator().on('submit',function (e) {
                if (! e.preventDefault()) {
                    $.ajax({
                        url: $('#modal-form form').attr('action'),
                        type: 'post',
                        data: $('#modal-form form').serialize()

                    })
                    .done((response)=> {
                        $('modal- form').modal('hide');
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak Dapat Menyimpan data');
                        return;
                    });
                }
            })

        });

        function addForm(url){
            $('#modal-form').modal('show');
            $('#modal-form.modal-title').text('Tambah Kategori');

            $('#nodal-form form')[0].reset();
            $('#modal-form form').attr('action',url);
            $('#modal-form [name=_method]').val('post');
            $('#modal-form [name=nmKategori]').focus();
        }
    </script>
@endpush
