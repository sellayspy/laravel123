
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
  <div class="modal-dialog" role="document">
   <form action="" method="post" class="form-horizontal">
    @csrf
    @method('post')
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>

      <div class="modal-body">
        <div class="form-group row">
            <label for="nmBarang" class="col-md-2 col-md-offset-1 control-label">Barang</label>
            <div class="col-md-9">
            <input type="text" name="nmBarang" id="nmBarang" class="form-control" required autofocus>
            <span class="help-block with-errors"></span>
            </div>

        </div>
        <div class="form-group row">
            <label for="kategori_id" class="col-md-2 col-md-offset-1 control-label">Kategori </label>
            <div class="col-md-9">
            <select name="kategori_id" id="kategori_id" class="form-control" required>
                <option value="">Pilih Kategori</option>
                @foreach ($kategori as $key => $item )
                    <option value="{{ $key }}">{{ $item }}</option>
                @endforeach
            </select>
            <span class="help-block with-errors"></span>
            </div>

        </div>
        <div class="form-group row">
            <label for="satuan" class="col-md-2 col-md-offset-1 control-label">Satuan</label>
            <div class="col-md-9">
            <input type="text" name="satuan" id="satuan" class="form-control" required autofocus>
            <span class="help-block with-errors"></span>
            </div>

        </div>
        <div class="form-group row">
            <label for="hargaSatuan" class="col-md-2 col-md-offset-1 control-label">Harga</label>
            <div class="col-md-9">
            <input type="number" name="hargaSatuan" id="hargaSatuan" class="form-control" required autofocus>
            <span class="help-block with-errors"></span>
            </div>

        </div>
        <div class="form-group row">
            <label for="stock" class="col-md-2 col-md-offset-1 control-label">Stock</label>
            <div class="col-md-9">
            <input type="text" name="stock" id="stock" class="form-control" required autofocus>
            <span class="help-block with-errors"></span>
            </div>

        </div>
        <div class="form-group row">
            <label for="tglExpired" class="col-md-2 col-md-offset-1 control-label">Tanggal Expired</label>
            <div class="col-md-9">
            <input type="date" name="tglExpired" id="tglExpired" class="form-control" required autofocus>
            <span class="help-block with-errors"></span>
            </div>

        </div>
      </div>
      <div class="modal-footer">
      <button  class="btn btn-sm btn-flat btn-primary">Simpan</button>
        <button type="button" class="btn btn-sm btn flat btn-default" data-dismiss="modal">Batal</button>
      </div>
    </div>
   </form>
  </div>
</div>
