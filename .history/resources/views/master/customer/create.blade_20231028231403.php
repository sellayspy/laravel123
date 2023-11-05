

<form action="{{ route('customers.store') }}" method="POST">
                    @csrf
                                <div class="form-group col-sm-4 mb-3 mb-sm-0">
                                    <input type="text" class="form-control @error('kdBarang)is-invalid @enderror" name="kdCustomer"
                                        placeholder="Masukan Kode" value="{{ old('kdCustomer') }}">
                                </div>
                                <div class="form-group col-sm-4 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" name="nmCustomer
                                        placeholder="Masukan Nama" value="{{ old('nmCustomer') }}">
                                </div>
                                <div class="form-group col-sm-4 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" name="alamat"
                                        placeholder="Masukan Satuan" value="{{ old('alamat') }}">
                                </div>
                                <div class="form-group col-sm-4 mb-3 mb-sm-0">
                                    <input type="number" class="form-control form-control-user" name="telepon"
                                        placeholder="Masukan Harga" value="{{ old('telepon') }}">
                                </div>


                                  <button type="submit" class="btn btn-primary">Tambah</button>
                 </form>

