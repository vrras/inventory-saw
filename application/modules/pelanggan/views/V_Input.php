<script type="text/javascript">
  function validasi(form){

   if (form.b.value.trim()=='') {
    alert('Nama Member wajib diisi terlebih dahulu');
    form.b.focus();
    return false;
  }
  if (form.f.value.trim()=='') {
    alert('Jenis Kelamin wajib diisi terlebih dahulu');
    form.f.focus();
    return false;
  }
  if (form.c.value.trim()=='') {
    alert('Nomor Telpon wajib diisi terlebih dahulu');
    form.c.focus();
    return false;
  }
  if (form.d.value.trim()=='') {
    alert('Alamat Wajib wajib diisi terlebih dahulu');
    form.d.focus();
    return false;
  }
  if (form.g.value.trim()=='') {
    alert('Nomor NIK Wajib wajib diisi terlebih dahulu');
    form.g.focus();
    return false;
  }
</script>

<script type="text/javascript">
  function angka(obj){
    var pola = "^";
    pola += "[0-9 ) ( - ]*";
    pola += "$";
    rx = new RegExp(pola);
    if (!obj.value.match(rx)){
      if (obj.lastMatched){
        obj.value = obj.lastMatched;
      }
      else {
        obj.value = "";
      }
    }
    else {
      obj.lastMatched = obj.value;
    }
  }
  function text(obj){
    var pola = "^";
    pola += "[a-zA-Z ' .]*";
    pola += "$";
    rx = new RegExp(pola);
    if (!obj.value.match(rx)){
      if (obj.lastMatched){
        obj.value = obj.lastMatched;
      }
      else {
        obj.value = "";
      }
    }
    else {
      obj.lastMatched = obj.value;
    }
  }
</script>

<div class="row">
  <div class="col-md-12"> 
    <div class="panel panel-default">
      <div class="panel-heading">         
        <h2 class="panel-title"> <b>Tambah Pelanggan</b></h2>                            
      </div>
      <div class="panel-body">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <form action="<?=base_url().'data/pelanggan/actionipt/'?>" method="POST" onsubmit="return validasi(this)" >
            <div class="form-group">
              <label class="control-label">Nama Pelanggan</label>
              <input name="form_nm_pelanggan" id="b" type="text" placeholder="Nama Pelanggan" class="form-control" autofocus="" onkeyup="return text(this);" >
            </div>        
            <div class="form-group">
              <label class="control-label">Jenis Kelamin</label>
              <select class="form-control" name="form_jk" id="f">
                <option value="">-- Pilih --</option>
                <option value="Laki-Laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">No. Handphone</label>
              <input name="form_hp" required="" type="text" placeholder="No. Handphone" class="form-control" autofocus="" onkeyup="return angka(this);" >
            </div> 
            <div class="form-group">
              <label class="control-label">Alamat</label>
              <textarea name="form_alamat" id="d" rows="4" placeholder="Alamat Lengkap" class="form-control"></textarea>
            </div>
            <input type="hidden" name="form_status" value="no_member">
            <div class="form-group">
              <input type="submit" class="btn btn-primary icon-btn" name="submit" value="SIMPAN">
              <input type="submit" class="btn btn-default" name="reset" value="BATAL">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>