@extends('layouts.main')
@section('title','Data Suplier')
@section('contents')

                               <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
                                </div>
                                <div class="card-body">
                                    <a href="{{route('supliers.create')}}" class="btn btn-primary mb-3">Tambah Data</a>
                                    <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                     <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Suplier</th>
                                            <th>Nama Suplier</th></th>
                                            <th>Alamat</th>
                                            <th>No Telepon</th>
                                            <th>Action</th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>

                                        @forelse ($supliers as $suplier )


                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ $suplier->kdsuplier }}</td>
                                            <td>{{ $suplier->nmsuplier }}</td>
                                            <td>{{ $suplier->alamat }}</td>
                                            <td>{{ $suplier->noTelepon }}</td>
                                            <td>

                                            <form action="{{ route('supliers.destroy', $suplier->id) }}" method="POST">
                                            <a href="{{ route('supliers.edit', $suplier->id) }}" class="btn btn-sm btn-warning">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                            </td>

                                         </tr>
                                         @empty
                                         <td class="text-center" colspan="6">Tidak ada Data.....</td>
                                        @endforelse

                                    </tfoot>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

@endsection
