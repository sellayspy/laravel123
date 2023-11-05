

<form action="{{ route('customers.update',['customer' => $customer->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                                <div class="form-group col-sm-4 mb-3 mb-sm-0">
                                    <input type="text" class="form-control @error('kdCustomer)is-invalid @enderror" name="kdCustomer"
                                        placeholder="Masukan Kode" value="{{ old('kdCustomer') }}" disabled>
                                </div>
                                <div class="form-group col-sm-4 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" name="nmCustomer"
                                        placeholder="Masukan Nama" value="{{ old('nmCustomer') ?? $customer->nmCustomer }}">
                                </div>
                                <div class="form-group col-sm-4 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" name="alamat"
                                        placeholder="Masukan Alamat" value="{{ old('alamat') ?? $customer->alamat }}">
                                </div>
                                <div class="form-group col-sm-4 mb-3 mb-sm-0">
                                    <input type="number" class="form-control form-control-user" name="noTelepon"
                                        placeholder="Masukan No Telepon" value="{{ old('noTelepon') ?? $customer->noTelepon }}">
                                </div>


                                  <button type="submit" class="btn btn-primary">Tambah</button>
                 </form>

