@extends('layouts.main')

@section('title', 'Form Barang')

@section('contents')
  <form action="{{ route('barangs.store) }}" method="post">
    @csrf
    <div class="row">
      <div class="col-12">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Data Barang</h6>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="kdBarang">Kode Barang</label>
              <input type="text" class="form-control" id="kdBarang" name="kdBarang" value="{{ old('kdBarang')}}">
            </div>
            <div class="form-group">
              <label for="nama_barang">Nama Barang</label>
              <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ isset($barang) ? $barang->nama_barang : '' }}">
            </div>
            <div class="form-group">
              <label for="id_kategori">Kategori Barang</label>
							<select name="id_kategori" id="id_kategori" class="custom-select">
								<option value="" selected disabled hidden>-- Pilih Kategori --</option>
								@foreach ($kategori as $row)
									<option value="{{ $row->id }}" {{ isset($barang) ? ($barang->id_kategori == $row->id ? 'selected' : '') : '' }}>{{ $row->nama }}</option>
								@endforeach
							</select>
            </div>
            <div class="form-group">
              <label for="harga">Harga Barang</label>
              <input type="number" class="form-control" id="harga" name="harga" value="{{ isset($barang) ? $barang->harga : '' }}">
            </div>
            <div class="form-group">
              <label for="jumlah">Jumlah Barang</label>
              <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ isset($barang) ? $barang->jumlah : '' }}">
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
