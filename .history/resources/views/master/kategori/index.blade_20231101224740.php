@extends('layouts.main')

@section('contents')

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
            <button class="btn btn-success xs btn-flat"><i class="fa fa-plus-circle"></i>Tambah</button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-stiped table-bordered">
                    <thead>
                        <th width="5%">No</th>
                        <th>Kategori</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        let table;

        $(function(){
            table  = $('.table').DataTable({
                processing: true,
                autoWidth:  false,
                ajax: {
                    url: '{{ route('kategori.data')}}',
                }
            });
        });
    </script>
@endpush
