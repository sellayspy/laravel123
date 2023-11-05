@extends('layouts.main')

@section('title', 'Form Customer')

@section('contents')
  <form action="{{ route('customers.store') }}" method="POST">
    @csrf
    <div class="row">
      <div class="col-12">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Data Customers</h6>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="kdCustomer">Kode Customer</label>
              <input type="text" class="form-control" id="kdCustomer" name="kdCustomer" value="{{ old('kdCustomer') }}">
            </div>
            <div class="form-group">
              <label for="nmCustomer">Nama Customer</label>
              <input type="text" class="form-control" id="nmCustomer" name="nmCustomer" value="{{ old('nmCustomer') }}">
            <div class="form-group">
              <label for="alamat">Alamat</label>
              <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat') }}">
            </div>
            <div class="form-group">
              <label for="noTelepon">No Telepon</label>
              <input type="number" class="form-control" id="noTelepon" name="noTelepon" value="{{ old('noTelepon') }}">
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