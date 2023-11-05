@extends('layouts.main')
@section('title','Data Customer')
@section('contents')

                               <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
                                </div>
                                <div class="card-body">
                                    <a href="{{route(customers.create')}}" class="btn btn-primary mb-3">Tambah Data</a>
                                    <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                     <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Customer</th>
                                            <th>Nama Customer</th></th>
                                            <th>Alamat</th>
                                            <th>No Telepon</th>
                                            <th>Action</th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>

                                        @forelse ($customers as $customer )


                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ $customer->kdBarang}}</td>
                                            <td>{{ $customer->nmBarang}}</td>
                                            <td>{{ $customer->satuan}}</td>
                                            <td>{{ $customer->hargaSatuan}}</td>
                                            <td>{{ $customer->stock}}</td>
                                            <td>{{ $customer->tglExpired}}</td>
                                            <td>

                                            <form action="{{ route('barangs.destroy', $customer->id)}}" method="POST">
                                        <a href="{{ route('barangs.edit', $customer->id) }}" class="btn btn-sm btn-warning">EDIT</a>
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
