
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
            <label for="namaProduk" class="col-md-2 col-md-offset-1 control-label">Nama</label>
            <div class="col-md-9">
            <input type="text" name="namaProduk" id="namaProduk" class="form-control" required autofocus>
            <span class="help-block with-errors"></span>
            </div>

        </div>
        <div class="form-group row">
            <label for="id_kategori" class="col-md-2 col-md-offset-1 control-label">Kategori</label>
            <div class="col-md-9">
           <select name="id_kategori" id="id_kategori" class="form-control" required>
            <option value="">Pilih Kategori</option>
            @foreach ($kategori as $key => $item)
                <option value="{{ $key }}">{{ $item }}</option>
            @endforeach
           </select>
            <span class="help-block with-errors"></span>
            </div>

        </div>
        <div class="form-group row">
            <label for="merk" class="col-md-2 col-md-offset-1 control-label">Merk</label>
            <div class="col-md-9">
            <input type="text" name="merk" id="merk" class="form-control">
            <span class="help-block with-errors"></span>
            </div>

        </div>
        <div class="form-group row">
            <label for="satuan" class="col-md-2 col-md-offset-1 control-label">Satuan</label>
            <div class="col-md-9">
            <input type="text" name="satuan" id="satuan" class="form-control">
            <span class="help-block with-errors"></span>
            </div>

        </div>
        <div class="form-group row">
            <label for="hargaSatuan" class="col-md-2 col-md-offset-1 control-label">Harga Satuan</label>
            <div class="col-md-9">
            <input type="number" name="hargaSatuan" id="hargaSatuan" class="form-control" required>
            <span class="help-block with-errors"></span>
            </div>

        </div>
        <div class="form-group row">
            <label for="stok" class="col-md-2 col-md-offset-1 control-label">Stok</label>
            <div class="col-md-9">
            <input type="number" name="stok" id="stok" class="form-control" required value="0">
            <span class="help-block with-errors"></span>
            </div>

        </div>

        <div class="form-group row">
            <label for="tglExpired" class="col-md-2 col-md-offset-1 control-label">Expired</label>
            <div class="col-md-9">
            <input type="date" name="tglExpired" id="tglExpired" class="form-control">
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
