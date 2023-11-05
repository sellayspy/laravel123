@extends('layouts.main')

@section('title','Form Barang')

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
                </div>
                <div class="card-body">
                                <div class="form-group">
                                    <input type="text" class="form-control @error('kdBarang)is-invalid @enderror" name="kdBarang"
                                        placeholder="Masukan Kode" value="{{ old('kdBarang') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="nmBarang"
                                        placeholder="Masukan Nama" value="{{ old('nmBarang') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="satuan"
                                        placeholder="Masukan Satuan" value="{{ old('satuan') }}">
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="hargaSatuan"
                                        placeholder="Masukan Harga" value="{{ old('hargaSatuan') }}">
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="stock"
                                        placeholder="Masukan Stock" value="{{ old('stock') }}">
                                </div>
                                <div class="form-group">
                                    <input type="date" class="form-control" name="tglExpired"
                                        placeholder="Masukan Tanggal Expired" value="{{ old('tglExpired') }}">
                                </div>
                                <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
            </div>
                </div>
            </div>
        </div>
    </div>
@endsection
