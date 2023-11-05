@extends('layouts.main')
@section('contents')
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

    .table-penjualan tbody tr:last-child {
        display: none;
    }

    @media(max-width: 768px) {
        .tampil-bayar {
            font-size: 3em;
            height: 70px;
            padding-top: 5px;
        }
    }
    </style>
    <div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-body">

                <form class="form-produk">
                    @csrf
                    <div class="form-group row">
                        <label for="kdBarang" class="col-lg-2">Kode Produk</label>
                        <div class="col-lg-5">
                            <div class="input-group">
                                <input type="hidden" name="d_jual_id" id="d_jual_id" value="">
                                <input type="hidden" name="barang_id" id="barang_id">
                                <input type="text" class="form-control" name="kdBarang" id="kdBarang">
                                <span class="input-group-btn">
                                    <button onclick="tampilBarang()" class="btn btn-info btn-flat" type="button"><i class="fa fa-arrow-right"></i></button>
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
                        <th>Satuan</th>
                        <th width="15%">Jumlah</th>
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
                        <form action="" class="form-penjualan" method="post">
                            @csrf
                            <input type="hidden" name="d_jual_id" value="">
                            <input type="hidden" name="total" id="total">
                            <input type="hidden" name="total_item" id="total_item">
                            <input type="hidden" name="bayar" id="bayar">
                            <input type="hidden" name="customer_id" id="customer_id" value="">

                            <div class="form-group row">
                                <label for="totalrp" class="col-lg-2 control-label">Total</label>
                                <div class="col-lg-8">
                                    <input type="text" id="totalrp" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kode_member" class="col-lg-2 control-label">Customer</label>
                                <div class="col-lg-8">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="kode_member" value="">
                                        <span class="input-group-btn">
                                            <button onclick="tampilMember()" class="btn btn-info btn-flat" type="button"><i class="fa fa-arrow-right"></i></button>
                                        </span>
                                    </div>
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
                                    <input type="number" id="diterima" class="form-control" name="diterima" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kembali" class="col-lg-2 control-label">Kembali</label>
                                <div class="col-lg-8">
                                    <input type="text" id="kembali" name="kembali" class="form-control" value="0" readonly>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-sm btn-flat pull-right btn-simpan"><i class="fa fa-floppy-o"></i> Simpan Transaksi</button>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script>

let table, table2;

$(function () {
    $('body').addClass('sidebar-collapse');

    table = $('.table-penjualan').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        ajax: {
            url: '{{ route('transaksi.data', $d_jual_id) }}',
        },
        columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'kdBarang'},
            {data: 'nmBarang'},
            {data: 'hargaJual'},
            {data: 'satuan'},
            {data: 'stock'},
            {data: 'tglExpired'},
            {data: 'aksi', searchable: false, sortable: false},
        ],
        dom: 'Brt',
        bSort: false,
        paginate: false
    })
    .on('draw.dt', function () {
        loadForm($('#diskon').val());
        setTimeout(() => {
            $('#diterima').trigger('input');
        }, 300);
    });
    table2 = $('.table-produk').DataTable();

    $(document).on('input', '.quantity', function () {
        let id = $(this).data('id');
        let jumlah = parseInt($(this).val());

        if (jumlah < 1) {
            $(this).val(1);
            alert('Jumlah tidak boleh kurang dari 1');
            return;
        }
        if (jumlah > 10000) {
            $(this).val(10000);
            alert('Jumlah tidak boleh lebih dari 10000');
            return;
        }

        $.post(`{{ url('/transaksi') }}/${id}`, {
                '_token': $('[name=csrf-token]').attr('content'),
                '_method': 'put',
                'jumlah': jumlah
            })
            .done(response => {
                $(this).on('mouseout', function () {
                    table.ajax.reload(() => loadForm($('#diskon').val()));
                });
            })
            .fail(errors => {
                alert('Tidak dapat menyimpan data');
                return;
            });
    });

    $(document).on('input', '#diskon', function () {
        if ($(this).val() == "") {
            $(this).val(0).select();
        }

        loadForm($(this).val());
    });

    $('#diterima').on('input', function () {
        if ($(this).val() == "") {
            $(this).val(0).select();
        }

        loadForm($('#diskon').val(), $(this).val());
    }).focus(function () {
        $(this).select();
    });

    $('.btn-simpan').on('click', function () {
        $('.form-penjualan').submit();
    });
});

function tampilProduk() {
    $('#modal-produk').modal('show');
}

function hideProduk() {
    $('#modal-produk').modal('hide');
}

function pilihProduk(id, kode) {
    $('#barang_id').val(id);
    $('#kdBarang').val(kode);
    hideProduk();
    tambahBarang();
}

function tambahBarang() {
    $.post('{{ route('transaksis.store') }}', $('.form-produk').serialize())
        .done(response => {
            $('#kdBarang').focus();
            table.ajax.reload(() => loadForm($('#diskon').val()));
        })
        .fail(errors => {
            alert('Tidak dapat menyimpan data');
            return;
        });
}

function tampilCustomer() {
    $('#modal-member').modal('show');
}

function pilihMember(id, kode) {
    $('#id_member').val(id);
    $('#kode_member').val(kode);
    $('#diskon').val('{{ $diskon }}');
    loadForm($('#diskon').val());
    $('#diterima').val(0).focus().select();
    hideMember();
}

function hideMember() {
    $('#modal-member').modal('hide');
}

function deleteData(url) {
    if (confirm('Yakin ingin menghapus data terpilih?')) {
        $.post(url, {
                '_token': $('[name=csrf-token]').attr('content'),
                '_method': 'delete'
            })
            .done((response) => {
                table.ajax.reload(() => loadForm($('#diskon').val()));
            })
            .fail((errors) => {
                alert('Tidak dapat menghapus data');
                return;
            });
    }
}

function loadForm(diskon = 0, diterima = 0) {
    $('#total').val($('.total').text());
    $('#total_item').val($('.total_item').text());

    $.get(`{{ url('/transaksi/loadform') }}/${diskon}/${$('.total').text()}/${diterima}`)
        .done(response => {
            $('#totalrp').val('Rp. '+ response.totalrp);
            $('#bayarrp').val('Rp. '+ response.bayarrp);
            $('#bayar').val(response.bayar);
            $('.tampil-bayar').text('Bayar: Rp. '+ response.bayarrp);
            $('.tampil-terbilang').text(response.terbilang);

            $('#kembali').val('Rp.'+ response.kembalirp);
            if ($('#diterima').val() != 0) {
                $('.tampil-bayar').text('Kembali: Rp. '+ response.kembalirp);
                $('.tampil-terbilang').text(response.kembali_terbilang);
            }
        })
        .fail(errors => {
            alert('Tidak dapat menampilkan data');
            return;
        })
}
</script>
@endpush