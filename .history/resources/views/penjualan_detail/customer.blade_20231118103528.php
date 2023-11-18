<div class="modal fade" id="modal-customer" tabindex="-1" role="dialog" aria-labelledby="modal-customer">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Pilih customer</h4>
      </div>

      <div class="modal-body">
               <table class="table table-striped table-bordered table-customer">
                <thead>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th><i class="fa fa-cog"></i></th>
                </thead>
                <tbody>
                    @foreach ($customer as $key => $item )
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->namaSuplier }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->noTelepon }}</td>
                            <td>
                            <a href="" class="btn btn-primary btn-xs btn-flat" onclick="pilihCustomer('{{ $item->id_customer }}','{{ $item->kode_member }}')">
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
