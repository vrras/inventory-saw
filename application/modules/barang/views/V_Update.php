<script type="text/javascript">
  function validasi(form){
    if (form.c.value.trim()=='') {
      alert('Nama Barang wajib diisi terlebih dahulu');
      form.c.focus();
      return false;
    }
    if (form.d.value.trim()=='') {
      alert('Quantity Barang wajib diisi terlebih dahulu');
      form.d.focus();
      return false;
    }
    if (form.e.value.trim()=='') {
      alert('Harga Barang wajib diisi terlebih dahulu');
      form.e.focus();
      return false;
    }
    if (form.f.value.trim()=='') {
      alert('Satuan Barang wajib diisi terlebih dahulu');
      form.f.focus();
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
        <h2 class="panel-title"> <b>Edit Barang</b></h2>                            
      </div>
      <div class="panel-body">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <?php foreach ($barang as $field_barang) { ?>
          <form action="<?=base_url().'data/barang/action'?>" method="POST" onsubmit="return validasi(this)" >
            <div class="form-group">
              <input name="form_id_barang" type="hidden" class="form-control" focus value="<?php echo $field_barang->id_barang; ?>">
            </div>
            <div class="form-group">
              <label class="control-label">Nama Barang</label>
              <input name="form_nm_barang" id="c" type="text" placeholder="Nama Barang" class="form-control" autofocus="" onkeyup="return text(this);" focus value="<?php echo  $field_barang->nm_barang; ?>">
            </div>
            <div class="form-group">
              <label class="control-label">Quantity</label>
              <input name="form_quantity" id="d" type="text" placeholder="Quantity" class="form-control" onkeyup="return angka(this);"  value="<?php echo $field_barang->quantity; ?>">
            </div>
            <div class="input-group"><span class="input-group-addon">Rp.</span>
             <input type="text" class="form-control" name="form_harga"  id="e" value="<?php echo $field_barang->harga; ?>">
           </div><br>
           <div class="form-group">
             <input type="submit" class="btn btn-primary icon-btn" name="submit" value="SIMPAN">
             <input type="button" class="btn btn-default" value="BATAL" onclick="history.back(-1)"">
           </div>
         </div>
       </form>
       <?php } ?>
     </div>
   </div>
 </div>
</div>
</div>