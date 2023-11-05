@extends('layouts.main')
@section('title','Data Barang')
@section('contents')
<form action="{{ route('barangs.update',['barang'=>$barang->id]) }}" method="POST">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
                </div>

                    @csrf
                    @method('PUT')
                    <div class="card-body">
                                <div class="form-group col-sm-4 mb-3 mb-sm-0">
                                    <input type="text" class="form-control @error('kdBarang)is-invalid @enderror" name="kdBarang"
                                        placeholder="Masukan Kode" value="{{ old('kdBarang') ?? $barang->kdBarang }}" disabled>
                                </div>
                                <div class="form-group col-sm-4 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" name="nmBarang"
                                        placeholder="Masukan Nama" value="{{ old('nmBarang') ?? $barang->nmBarang }}">
                                </div>
                                <div class="form-group col-sm-4 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" name="satuan"
                                        placeholder="Masukan Satuan" value="{{ old('satuan') ?? $barang->satuan }}">
                                </div>
                                <div class="form-group col-sm-4 mb-3 mb-sm-0">
                                    <input type="number" class="form-control form-control-user" name="hargaSatuan"
                                        placeholder="Masukan Harga" value="{{ old('hargaSatuan') ?? $barang->hargaSatuan }}">
                                </div>
                                <div class="form-group col-sm-4 mb-3 mb-sm-0">
                                    <input type="number" class="form-control form-control-user" name="stock"
                                        placeholder="Masukan Stock" value="{{ old('stock') ?? $barang->stock }}">
                                </div>
                                <div class="form-group col-sm-4 mb-3 mb-sm-0">
                                    <input type="date" class="form-control form-control-user" name="tglExpired"
                                        placeholder="Masukan Tanggal Expired" value="{{ old('tglExpired') ?? $barang->tglExpired }}">
                                </div>
                                </div>
                                <div>
                                  <button type="submit" class="btn btn-primary">Update Data</button>
                    </div>
            </div>
        </div>
    </div>
</form>
@endsection
