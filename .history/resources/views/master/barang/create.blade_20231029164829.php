@extends('layouts.main')

@section('title','Form Data')

@section('contents')

<form action="{{ route('barangs.store') }}" method="POST">
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h3 class="m-0 font-weight-bold text-primary">Tambah Barang</h3>
            </div>
            <div class="card-body">
                    @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control @error('kdBarang)is-invalid @enderror" name="kdBarang"
                                        placeholder="Masukan Kode" value="{{ old('kdBarang') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="nmBarang"
                                        placeholder="Masukan Nama" value="{{ old('nmBarang') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="satuan"
                                        placeholder="Masukan Satuan" value="{{ old('satuan') }}">
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-user" name="hargaSatuan"
                                        placeholder="Masukan Harga" value="{{ old('hargaSatuan') }}">
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-user" name="stock"
                                        placeholder="Masukan Stock" value="{{ old('stock') }}">
                                </div>
                                <div class="form-group">
                                    <input type="date" class="form-control form-control-user" name="tglExpired"
                                        placeholder="Masukan Tanggal Expired" value="{{ old('tglExpired') }}">
                                </div>
                                <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection
