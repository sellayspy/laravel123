
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
            <label for="namaSuplier" class="col-md-2 col-md-offset-1 control-label">Nama</label>
            <div class="col-md-9">
            <input type="text" name="namaSuplier" id="namaSuplier" class="form-control" required autofocus>
            <span class="help-block with-errors"></span>
            </div>

        </div>
        <div class="form-group row">
            <label for="alamat" class="col-md-2 col-md-offset-1 control-label">alamat</label>
            <div class="col-md-9">
          <textarea name="alamat" id="alamat" rows="3" class="form-control"></textarea>
            <span class="help-block with-errors"></span>
            </div>

        </div>
        <div class="form-group row">
            <label for="noTelepon" class="col-md-2 col-md-offset-1 control-label">Telepon</label>
            <div class="col-md-9">
            <input type="text" name="noTelepon" id="noTelepon" class="form-control" required>
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
