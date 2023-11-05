
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
  <div class="modal-dialog" role="document">
   <form action="" method="post" class="form-horizontal">
    @csrf
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <div class="form-group row">
            <label for="nmKategori" class="col-md-2 col-md-ofset-1">Nama Kategori</label>
            <div class="col-md-10">
            <input type="text" name="nmKategori" id="nmKategori" class="from-control" required autofocus>
            <span class="help-block with-errors"></span>
            </div>

        </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
      </div>
    </div>
   </form>
  </div>
</div>
