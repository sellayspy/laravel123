@extends('layouts.main')
@section('contents')
    <style>
        .form-control {
            border-color: #bdbdbd;
        }

        .form-control-solid {
            border-color: #e3e3e3;
            border-radius: 10px;
        }
    </style>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <span class="card-icon">
                            <i class="flaticon2-supermarket text-primary"></i>
                        </span>
                        <h3 class="card-label">Orders</h3>
                        <button type="button" class="btn btn-success" data-toggle="modal"
                            data-target=".bd-example-modal-lg">Pilih Barang</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <!--begin: Datatable-->
                            <div class="table-responsive text-nowrap" style="width: 710px">
                                <table class="table table-bordered table-hover table-checkable table-responsive"
                                    id="data_order" style="margin-top: 13px !important, margin-right:13px;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Satuan</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Total Belanja</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="show_data">

                                    </tbody>
                                </table>
                                <div class="modal fade bd-example-modal" id="ModalHapus" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <h4 class="modal-title" id="myModalLabel">Hapus Barang</h4>
                                            </div>
                                            <form class="form-horizontal">
                                                <div class="modal-body">

                                                    <input type="hidden" name="id" id="textkode" value="">
                                                    <div class="alert alert-warning">
                                                        <p>Apakah Anda yakin mau memhapus barang ini?</p>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button class="btn_hapus btn btn-danger" id="btn_hapus">Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade bd-example-modal" id="ModalLunas" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <h4 class="modal-title" id="myModalLabel">Yakin Pembelian Sudah Benar?
                                                    </h4>
                                            </div>
                                            <form action="/struck" class="form-horizontal">
                                                <div class="modal-body">
                                                    <div class="alert alert-info">
                                                        <p>Tekan Bayar Jika Sudah Benar</p>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="Generate Otomatis" readonly value="{{ rand(0000, 9999) }}"
                                                    name="id_transaction" id="id_transaction" hidden />
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="Generate Otomatis" readonly value=""
                                                    name="id_user" id="id_user" hidden />
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button class="btn_hapus btn btn-primary" id="lunas">Bayar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade bd-example-modal" id="ModalBatal" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <h4 class="modal-title" id="myModalLabel">Yakin Ingin Membatalkan?
                                                    </h4>
                                            </div>
                                            <form class="form-horizontal">
                                                <div class="modal-body">
                                                    <div class="alert alert-info">
                                                        <p>Tekan Batal</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button class="btn_hapus btn btn-primary"
                                                        id="batal">Batal</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--end: Datatable-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <span class="card-icon">
                            <i class="flaticon2-supermarket text-primary"></i>
                        </span>
                        <h3 class="card-label">Orders</h3>
                    </div>
                </div>
                <div class="row" style="margin-left: 0px;">
                    <div class="col-md-5">

                        <div class="form-group">
                            <label>No Transaksi<span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-solid" placeholder="Generate Otomatis"
                                readonly value="" name="cabang" id="cabang" />
                            <input type="text" class="form-control form-control-solid" placeholder="Generate Otomatis"
                                readonly value="" name="id_cabang" id="id_cabang" hidden />
                        </div>
                    </div>
                    <br>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Kode Customer<span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-solid" placeholder="Generate Otomatis"
                                name="name" id="name" />
                            <input type="text" class="form-control form-control-solid" placeholder="Generate Otomatis"
                                name="id_user" id="id_user" hidden />
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group gettotalbarang">
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group cash-all-lunas">
                            <label>Total Bayar<span class="text-danger">*</span>
                            </label>
                            <input type="text" id="cash" name="cash" onkeyup="getcashback(this.value)"
                                class="form-control rupiah" min="0" max="100" required>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group">
                            <label>Kembalian<span class="text-danger">*</span></label>
                            <input type="text" id="caseback" class="form-control form-control-solid" readonly
                                name="caseback" min="0" max="100">
                        </div>
                    </div>
                    <div class="col-md-10" id="lunas-modal">
                        <div class="form-group">
                            <button class="btn btn-primary" id="lunas">Bayar</button>
                            <button class="btn btn-danger" id="batal">Batal</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pilih Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover table-checkable table-responsive"
                                id="datatable" style="margin-top: 13px !important, margin-right:13px;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th hidden>id</th>
                                        <th>Nama Barang</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>stok</th>
                                        <th>Jumlah</th>
                                        <th>Satuan</th>
                                        <th>Actions</th>

                                    </tr>
                                </thead>

                                <tbody id="data_product">


                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
