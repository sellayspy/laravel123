@extends('layouts.main')
@section('title','Data Barang')
@section('content')

                               <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
                                </div>
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
