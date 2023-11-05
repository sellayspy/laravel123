@extends('layouts.main')

@section('title', 'Form Edit')

@section('contents')
  <form action="{{ route('barangs.update') }}" method="POST">
    @csrf
    <div class="row">
      <div class="col-12">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Barang</h6>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="kdBarang">Kode Barang</label>
              <input type="text" class="form-control" id="kdBarang" name="kdBarang" value="{{ old('kdBarang') ?? $barang->kdBarang }}" disabled>
            </div>
            <div class="form-group">
              <label for="nmBarang">Nama Barang</label>
              <input type="text" class="form-control" id="nmBarang" name="nmBarang" value="{{ old('nmBarang') ?? $barang->nmBarang }}">
            <div class="form-group">
              <label for="satuan">Nama Satuan</label>
              <input type="text" class="form-control" id="satuan" name="satuan" value="{{ old('satuan') ?? $barang->satuan }}">
            </div>
            <div class="form-group">
              <label for="hargaSatuan">Harga Satuan</label>
              <input type="number" class="form-control" id="hargaSatuan" name="hargaSatuan" value="{{ old('hargaSatuan') ?? $barang->hargaSatuan }}">
            </div>
            <div class="form-group">
              <label for="stock">Stock</label>
              <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock') ?? $barang->stock }}">
            </div>
            <div class="form-group">
              <label for="tglExpired">Harga Satuan</label>
              <input type="date" class="form-control" id="tglExpired" name="tglExpired" value="{{ old('tglExpired') ?? $barang->tglExpired }}">
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </div>
    </div>
  </form>
@endsection
