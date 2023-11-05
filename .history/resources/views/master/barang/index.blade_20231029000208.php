@extends('layouts.main')
@section('content')

<h1 class="h3 mb-2 text-gray-800">Data Barang</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                           <a href="{{route('barangs.create')}}" class="btn btn-primary">  Tambah Data </a>

                           <form method="GET">
        <div class="input-group mb-3">
          <input type="text" name="search" value="{{ request()->get('search') }}" class="form-control" placeholder="Search..."  aria-label="Search" aria-describedby="button-addon2">
          <button class="btn btn-success" type="submit" id="button-addon2">Search</button>
        </div>
    </form>

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                     <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th></th>
                                            <th>Satuan</th>
                                            <th>Harga Satuan</th>
                                            <th>Stock</th>
                                            <th>Tanggal_Expired</th>
                                            <th>Action</th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>

                                        @forelse ($barangs as $barang )


                                        <tr>
                                            <th>{{$loop->iteration}}</th>
                                            <th>{{ $barang->kdBarang}}</th>
                                            <th>{{ $barang->nmBarang}}</th>
                                            <th>{{ $barang->satuan}}</th>
                                            <th>{{ $barang->hargaSatuan}}</th>
                                            <th>{{ $barang->stock}}</th>
                                            <th>{{ $barang->tglExpired}}</th>
                                            <th>

                                            <form action="{{ route('barangs.destroy', $barang->id)}}" method="POST">
                                        <a href="{{ route('barangs.edit', $barang->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                            </th>

                                         </tr>
                                         @empty

                                        @endforelse

                                    </tfoot>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

@endsection
