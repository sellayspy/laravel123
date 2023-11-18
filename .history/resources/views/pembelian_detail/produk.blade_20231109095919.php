<div class="modal fade" id="modal-supplier" tabindex="-1" role="dialog" aria-labelledby="modal-supplier">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Pilih Supplier</h4>
      </div>

      <div class="modal-body">
               <table class="table table-striped table-bordered">
                <thead>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th></th>
                    <th>Harga Beli</th>
                    <th><i class="fa fa-cog"></i></th>
                </thead>
                <tbody>
                    @foreach ($produk as $key => $list )
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $list->namaSuplier }}</td>
                            <td>{{ $list->alamat }}</td>
                            <td>{{ $list->noTelepon }}</td>
                            <td>
                                <a href="{{ route('pembelian.create', $list->id_suplier) }}" class="btn btn-primary btn-xs btn-flat">
                                    <i class="fa fa-check-circle"></i>
                                    Pilih
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
               </table>
      </div>
    </div>
  </div>
</div>
