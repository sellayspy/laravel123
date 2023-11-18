@extends('layouts.main')

@section('title')
   Daftar Pembelian
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Daftar Pembelian</li>
@endsection

@section('contents')

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
            <button onclick="addForm()" class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus-circle"></i>Transaksi Baru</button>
            @empty(! session('id_pembelian'))
            <a href="{{ route('pembelian_detail.index') }}" class="btn btn-info btn-xs btn-flat"><i>Transaksi Aktif</i></a>
            @endempty
            </div>
            <div class="box-body table-responsive">
                <table class="table table-stiped table-bordered table-pembelian">
                    <thead>
                        <th width="5%">No</th>
                        <th>Tanggal</th>
                        <th>Suplier</th>
                        <th>Total Item</th>
                        <th>Total Harga</th>
                        <th>Diskon</th>
                        <th>Total Bayar</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>

                </table>
            </div>
        </div>
    </div>
</div>
@includeIf('pembelian.suplier')
@includeIf('pembelian.detail')
@endsection

@push('scripts')
    <script>
        let table,table1;

        $(function () {
            table  = $('.table-pembelian').DataTable({
               processing: true,
               autoWidth:  false,
            ajax: {
                url: '{{ route('pembelian.data') }}',
             },
              columns: [
               {data: 'DT_RowIndex', searchable: false, shortable: false},
                {data: 'tanggal'},
                {data: 'supplier'},
                {data: 'totalItem'},
                {data: 'totalHarga'},
                {data: 'diskon'},
                {data: 'bayar'},
                {data: 'aksi', searchable: false, shortable: false},
              ]
            });

            table  = $('.table-supplier').DataTable({
                table1 = $('.table-detail').DataTable({
                    processing: true,
                    bsort: false,
                    dom: 'Brt',
                    columns: [
                              {data: 'DT_RowIndex', searchable: false, shortable: false},
                              {data: 'tanggal'},
                              {data: 'supplier'},
                              {data: 'totalItem'},
                              {data: 'totalHarga'},
                              {data: 'diskon'},
                              {data: 'bayar'},
                              {data: 'aksi', searchable: false, shortable: false},
                            ]
                })
            });

        });

        function addForm() {
            $('#modal-supplier').modal('show');
        }

        function showDetail(){
            $('#modal-detail').modal('show');

            table1.ajax.url(url).reload();
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
