@extends('layouts.main')
@section('content')


@extends('layouts.index')
@section('content')
                <form action="{{ route('passiens.store') }}" method="POST">
                    @csrf
                                <div class="form-group col-sm-4 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" name="nama" id="nama"
                                        placeholder="Masukan Nama" value="{{ old('nama') }}">
                                </div>
                                <div class="form-group col-sm-4 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" name="kontak" id="kontak"
                                        placeholder="Masukan kontak" value="{{ old('kontak') }}">
                                </div>
                                <div class="form-group col-sm-4 mb-3 mb-sm-0">
                                    <input type="email" class="form-control form-control-user" name="email" id="email"
                                        placeholder="Masukan email" value="{{ old('email') }}">
                                </div>
                                <div class="form-group col-sm-4 mb-3 mb-sm-0">
                                    <input type="date" class="form-control form-control-user" name="tanggal_lahir" id="tanggal_lahir"
                                        placeholder="Masukan Tanggal Lahir" value="{{ old('tanggal_lahir') }}">
                                </div>
                                <div class="form-group col-sm-4 mb-3 mb-sm-0">
                                    <input type="date" class="form-control form-control-user" name="tanggal_gabung" id="tanggal_gabung"
                                        placeholder="Tanggal Masuk" value="{{ old('tanggal_gabung') }}">
                                </div>
                                <div class="form-group col-sm-4 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" name="alamat" id="alamat"
                                        placeholder="Masukan Alamat" value="{{ old('alamat') }}">
                                </div>


                                  <button type="submit" class="btn btn-primary">Tambah</button>
                 </form>
@endsection


@endsection
