@extends('layouts.main')
@section('title','Data Barang')
@section('contents')

                               <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
                                </div>
                                <div class="card-body">
                                    <a href="{{route('barangs.create')}}" class="btn btn-primary">Tambah Data</a>
                                    <div class="table-responsive">
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
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ $barang->kdBarang}}</td>
                                            <td>{{ $barang->nmBarang}}</td>
                                            <td>{{ $barang->satuan}}</td>
                                            <td>{{ $barang->dargaSatuan}}</td>
                                            <td>{{ $barang->stock}}</td>
                                            <td>{{ $barang->tglExpired}}</td>
                                            <td>

                                            <form action="{{ route('barangs.destroy', $barang->id)}}" method="POST">
                                        <a href="{{ route('barangs.edit', $barang->id) }}" class="btn btn-sm btn-warning">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                            </td>

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
