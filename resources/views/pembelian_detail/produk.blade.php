<div class="modal fade" id="modal-produk" tabindex="-1" role="dialog" aria-labelledby="modal-produk">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Pilih Produk</h4>
      </div>

      <div class="modal-body">
               <table class="table table-striped table-bordered table-produk">
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
                            <td><span class="label label-success">{{ $list->kode_produk }}</span></td>
                            <td>{{ $list->namaProduk }}</td>
                            <td>{{ $list->hargaBeli }}</td>
                            <td>
                                <a href="" class="btn btn-primary btn-xs btn-flat" onclick="pilihProduk('{{ $list->id_produk }}','{{ $list->kode_produk }}')">
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
