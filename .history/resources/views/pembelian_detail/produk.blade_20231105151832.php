<div class="modal fade" id="modal-produk" tabindex="-1" role="dialog" aria-labelledby="modal-produk">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Pilih Produk</h4>
      </div>

      <div class="modal-body">
        <table class="table table-striped table-bordered">
            <thead>
                <th width="5%">No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Harga Beli</th>
                <th><i class="fa fa-cog"></i></th>
            </thead>
            <tbody>
                @foreach ($produk as $key=>$item )
                <tr>
                    <td width="5%">{{ $key }}</td>
                    <td><div class="span label label-success">{{ $item->kodeProduk }}</div></td>
                    <td>{{ $item->namaProduk }}</td>
                    <td>{{ $item->hargaSatuan }}</td>
                    <td>
                        <a href="" class="btn btn-primary btn-xs btn-flat">
                            <i class="fa fa-check-circle" onclick="pilihProduk('{{ $item->id_produk }}','{{ $item->kodeProduk }}')"></i>
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
