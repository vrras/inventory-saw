 <script type="text/javascript">
  function validasi(form){
    if (form.c.value.trim()=='') {
      alert('NIK Pelanggan wajib diisi terlebih dahulu');
      form.a.focus();
      return false;
    }
    if (form.b.value.trim()=='') {
      alert('Nama Pelanggan wajib diisi terlebih dahulu');
      form.b.focus();
      return false;
    }
    if (form.c.value.trim()=='') {
      alert('No. Telepon Pelanggan wajib diisi terlebih dahulu');
      form.c.focus();
      return false;
    }
    if (form.d.value.trim()=='') {
      alert('Alamat wajib diisi terlebih dahulu');
      form.d.focus();
      return false;
    }
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
        <h2 class="panel-title"> <b>Edit Pelanggan</b></h2>                            
      </div>
      <div class="panel-body">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <form action="<?=base_url().'data/pelanggan/action/'?>" method="POST" onsubmit="return validasi(this)" >
            <?php foreach ($pelanggan as $field_pelanggan) { ?>
            <div class="form-group">
              <label class="control-label">Status</label>
              <select <?php echo $field_pelanggan->status == 'member' ? 'readonly':''; ?> name="form_status" style="height: 32px;" class="form-control">
                <option value="member" <?php echo $field_pelanggan->status == 'member' ? 'selected="selected"':''; ?>>Member</option>
                <option value="no_member" <?php echo $field_pelanggan->status == 'no_member' ? 'selected="selected"':''; ?> >Pelanggan</option>
              </select>
            </div>
            <div class="form-group">
              <input name="form_id_pelanggan" type="hidden"  placeholder="" class="form-control" focus value="<?php echo $field_pelanggan->id_pelanggan; ?>">
            </div>
            <div class="form-group">
              <label <?php echo $field_pelanggan->status == 'member' ? '':'hidden'; ?> class="control-label">NIK</label>
              <input <?php echo $field_pelanggan->status == 'member' ? 'type="text"':'type="hidden"'; ?> name="form_nik"  <?php echo $field_pelanggan->status == 'member' ? 'id="a"':''; ?>  placeholder="NIK" class="form-control" autofocus="" onkeyup="return angka(this);" focus value="<?php echo $field_pelanggan->NIK; ?>">
            </div>
            <div class="form-group">
              <label class="control-label">Nama Pelanggan</label>
              <input name="form_nm_pelanggan" id="b" type="text" placeholder="Nama Pelanggan" class="form-control" autofocus="" onkeyup="return text(this);" focus value="<?php echo $field_pelanggan->nama_pelanggan; ?>">
            </div>
            <div class="form-group">
              <label class="control-label">Jenis Kelamin</label>
              <select name="form_jk" style="height: 32px;" class="form-control">
                <option value="Laki-Laki" <?php echo $field_pelanggan->jenis_kelamin == 'Laki-Laki' ? 'selected="selected"':''; ?>>Laki-Laki</option>
                <option value="Perempuan" <?php echo $field_pelanggan->jenis_kelamin == 'Perempuan' ? 'selected="selected"':''; ?> >Perempuan</option>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Nomor Telepon</label>
              <input type="text" name="form_hp" id="c" placeholder="No. Telepon" class="form-control" onkeyup="return angka(this);" value="<?php echo $field_pelanggan->no_telpon; ?>" required>
            </div>
            <div class="form-group">
              <label class="control-label">Alamat</label>
              <textarea name="form_alamat" id="d" rows="4" placeholder="Alamat" class="form-control" ><?php echo $field_pelanggan->alamat; ?></textarea>
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-primary icon-btn" name="submit" value="SIMPAN">
              <input type="button" class="btn btn-default" value="BATAL" onclick="history.back(-1)"">
            </div>
            <?php } ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>