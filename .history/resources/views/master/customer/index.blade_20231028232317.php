@extends('layouts.main')
@section('content')

<h1 class="h3 mb-2 text-gray-800">Data Customers</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Customer</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                           <a href="{{route('customers.create')}}" class="btn btn-primary">  Tambah Data </a>

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
                                            <th>{{$loop->iteration}}</th>
                                            <th>{{ $customer->kdCustomer}}</th>
                                            <th>{{ $customer->nmCustomer}}</th>
                                            <th>{{ $customer->alamat}}</th>
                                            <th>{{ $customer->noTelpon}}</th>

                                            <th>

                                            <form action="{{ route('customers.destroy', $barang->id)}}" method="POST">
                                        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-sm btn-primary">EDIT</a>
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
