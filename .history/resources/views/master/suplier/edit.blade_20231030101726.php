@extends('layouts.main')

@section('title', 'Form Edit Suplier')

@section('contents')
  <form action="{{ route('supliers.update',['suplier'=>$suplier->id]) }}" method="POST">
    @csrf
    <div class="row">
      <div class="col-12">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Data Suplier</h6>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="kdSuplier">Kode Suplier</label>
              <input type="text" class="form-control" id="kdSuplier" name="kdSuplier" value="{{ old('kdSuplier') ??$suplier->kdSuplier }}" disabled>
            </div>
            <div class="form-group">
              <label for="nmSuplier">Nama Suplier</label>
              <input type="text" class="form-control" id="nmSuplier" name="nmSuplier" value="{{ old('nmSuplier') ??$suplier->nmSuplier }}">
            <div class="form-group">
              <label for="alamat">Alamat</label>
              <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat') ??$suplier->alamat }}">
            </div>
            <div class="form-group">
              <label for="noTelpon">No Telepon</label>
              <input type="number" class="form-control" id="noTelpon" name="noTelpon" value="{{ old('noTelpon') ??$suplier->noTelpon }}">
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </div>
      </div>
    </div>
  </form>
@endsection
