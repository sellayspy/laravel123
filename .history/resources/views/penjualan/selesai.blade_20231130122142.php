@extends('layouts.main')

@section('title')
   Transaksi Selesai
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Daftar Penjualan</li>
@endsection

@section('contents')

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body table-responsive">
                <div class="alert alert-success alert-dismissible">
                    <i class="fa fa-check icon"></i>
                    Transaksi Berhasil
                </div>
            </div>
            <div class="box-footer">
            <button class="btn btn-warning btn-flat">Cetak Ulang Nota</button>
            <a href="{{ route('transaksi.baru')}}" class="btn btn-primary btn-flat">Transaksi Baru</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>

</script>
@endpush
