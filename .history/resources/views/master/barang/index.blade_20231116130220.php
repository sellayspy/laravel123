@extends('layouts.main')

@section('title')
    Daftar Produk
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Produk</li>
@endsection

@section('contents')

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="btn-group">
                <button onclick="addForm('{{ route('produk.store') }}')" class="btn btn-success xs btn-flat"><i class="fa fa-plus-circle"></i>Tambah</button>
                <button onclick="deleteSelected('{{ route('produk.delete_selected') }}')" class="btn btn-danger xs btn-flat"><i class="fa fa-trash"></i>Hapus</button>
                <button onclick="cetakBarcode('{{ route('produk.cetak_barcode') }}')" class="btn btn-info xs btn-flat"><i class="fa fa-barcode"></i>Cetak Barcode</button>
                </div>
            </div>
            <div class="box-body table-responsive">
               <form action="" class="form-produk">
                @csrf
                <table class="table table-stiped table-bordered">
                    <thead>
                        <th>
                            <input type="checkbox" name="select_all" id="select_all">
                        </th>
                        <th width="5%">No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Merk</th>
                        <th>Satuan</th>
                        <th>Harga Jual</th>
                        <th>Harga Beli</th>
                        <th>Stock</th>
                        <th>Expired</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>

                </table>
               </form>
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
            $('body').addClass('sidebar-collapse');
            table  = $('.table').DataTable({
                processing: true,
                autoWidth:  false,
             ajax: {
                 url: '{{ route('produk.data') }}',
             },
               columns: [
                {data: 'select_all'},
                {data: 'DT_RowIndex', searchable: false, shortable: false},
                {data: 'kode_produk'},
                {data: 'namaProduk'},
                {data: 'namaKategori'},
                {data: 'merk'},
                {data: 'satuan'},
                {data: 'hargaJual'},
                {data: 'hargaBeli'},
                {data: 'stok'},
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
            });

            $('[name=select_all]').on('click',function () {
                $(':checkbox').prop('checked', this.checked);
            });

        });

        function addForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah Produk');

           $('#modal-form form')[0].reset();
           $('#modal-form form').attr('action',url);
            $('#modal-form [name=_method]').val('post');
            $('#modal-form [name=namaProduk]').focus();
        }

        function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Kategori');

           $('#modal-form form')[0].reset();
           $('#modal-form form').attr('action',url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form [name=namaProduk]').focus();

            $.get(url)
            .done((response) => {
                $('#modal-form [name=namaProduk]').val(response.namaProduk);
                $('#modal-form [name=id_kategori]').val(response.id_kategori);
                $('#modal-form [name=merk]').val(response.merk);
                $('#modal-form [name=satuan]').val(response.satuan);
                $('#modal-form [name=hargaJual]').val(response.hargaJual);
                $('#modal-form [name=hargaBeli]').val(response.hargaBeli);
                $('#modal-form [name=stok]').val(response.stok);
                $('#modal-form [name=tglExpired]').val(response.tglExpired);
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
            });
        }
        }
        function deleteSelected(url) {
            if ($('input:checked').length > 1) {
             if (confirm('Yakin Ingin Mengahapus SemuaData?')) {
                $.post(url, $('.form-produk').serialize())
                .done((response) => {
                    table.ajax.reload();
                })
                .fail((errors) => {
                    alert('Tidak Dapat Menghapus Data');
                    return;
                });
             }
            }else{
                alert('Pilih Data Yang Di Hapus');
                return;
            }
        }

        function cetakBarcode()
        {
            if ($('input:checked').length > 1) {
        }else{
            alert('Pilih Data Yang Ingin Di Cetak')
            return;
        }
    }
    </script>
@endpush
