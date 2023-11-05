@extends('layouts.main')
@section('title','Form Data')
@section('contents')

<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h3 class="m-0 font-weight-bold text-primary">Tambah Barang</h3>
            </div>
        </div>
    </div>
</div>
                <form action="{{ route('barangs.store') }}" method="POST">
                    @csrf
                                <div class="form-group col-sm-4 mb-3 mb-sm-0">
                                    <input type="text" class="form-control @error('kdBarang)is-invalid @enderror" name="kdBarang"
                                        placeholder="Masukan Kode" value="{{ old('kdBarang') }}">
                                </div>
                                <div class="form-group col-sm-4 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" name="nmBarang"
                                        placeholder="Masukan Nama" value="{{ old('nmBarang') }}">
                                </div>
                                <div class="form-group col-sm-4 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" name="satuan"
                                        placeholder="Masukan Satuan" value="{{ old('satuan') }}">
                                </div>
                                <div class="form-group col-sm-4 mb-3 mb-sm-0">
                                    <input type="number" class="form-control form-control-user" name="hargaSatuan"
                                        placeholder="Masukan Harga" value="{{ old('hargaSatuan') }}">
                                </div>
                                <div class="form-group col-sm-4 mb-3 mb-sm-0">
                                    <input type="number" class="form-control form-control-user" name="stock"
                                        placeholder="Masukan Stock" value="{{ old('stock') }}">
                                </div>
                                <div class="form-group col-sm-4 mb-3 mb-sm-0">
                                    <input type="date" class="form-control form-control-user" name="tglExpired"
                                        placeholder="Masukan Tanggal Expired" value="{{ old('tglExpired') }}">
                                </div>


                                  <button type="submit" class="btn btn-primary">Tambah</button>
                 </form>
@endsection
