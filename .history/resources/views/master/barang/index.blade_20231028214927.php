@extends('layouts.main')
@section('content')

<h1 class="h3 mb-2 text-gray-800">Laporan Barang</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Laporan Barang</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th></th>
                                            <th>Satuan</th>
                                            <th>Harga Satuan</th>
                                            <th>Tanggal_Expired</th>
                                            <th>Stock</th>
                                            <th>Action</th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>

                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>

                                         </tr>


                                    </tfoot>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

@endsection
