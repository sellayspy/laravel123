<div class="modal fade" id="modal-supplier" tabindex="-1" role="dialog" aria-labelledby="modal-supplier">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Pilih Suplier</h4>
      </div>

      <div class="modal-body">
        <table class="table table-striped table-bordered">
            <thead>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Harga Beli</th>
                <th><i class="fa fa-cog"></i></th>
            </thead>
            <tbody>
                @foreach ($suplier as $key=>$item )
                <tr>
                    <td>{{ $key }}</td>
                    <td>{{ $item->kodeProduk }}</td>
                    <td>{{ $item->namaProduk }}</td>
                    <td>{{ $item->hargaSatuan }}</td>
                    <td>
                        <a href="{{ route('pembelian.create', $item->id_suplier) }}" class="btn btn-primary btn-xs btn-flat">
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