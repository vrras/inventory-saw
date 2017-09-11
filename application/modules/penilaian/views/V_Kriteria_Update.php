<script type="text/javascript">
  function angka(obj){
    var pola = "^";
    pola += "[0-9 ) ( - .]*";
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
        <h2 class="panel-title"> <b>Edit Kriteria</b></h2>                            
      </div>
      <div class="panel-body">
        <div class="col-md-12">
          <form action="<?=base_url().'penilaian/kriteria/action'?>" method="POST">
            <?php foreach ($kriteria as $field_kriteria) { ?>
            <div class="col-md-4">
              <div class="form-group">
                <input name="form_id_kriteria[]" type="hidden" placeholder="" class="form-control" focus value="<?php echo $field_kriteria->id_kriteria; ?>">
              </div>
              <div class="form-group">
                <label class="control-label">Nama Kriteria</label>
                <input readonly name="form_nm_kriteria[]" required="required" type="text" placeholder="Nama Kriteria" class="form-control" autofocus="" onkeyup="return text(this);" focus value="<?php echo $field_kriteria->nm_kriteria; ?>">
              </div>
              <div class="form-group">
                <label class="control-label">Atribut</label>
                <select class="form-control" name="form_atribut[]" id="f">
                  <option <?php echo $field_kriteria->atribut == 'cost' ? 'selected="selected"' : ''; ?> value="cost">Cost</option>
                  <option  <?php echo $field_kriteria->atribut == 'benefit' ? 'selected="selected"' : ''; ?> value="benefit">Benefit</option>
                </select>
              </div>
              <label class="control-label">Bobot</label>
              <div class="input-group">              
                <input name="form_bobot[]" required="required" type="text" placeholder="Bobot" class="form-control" onkeyup="return angka(this);" onkeyup="return persen(this);" value="<?php echo $field_kriteria->bobot*100; ?>"><span class="input-group-addon">%</span>
              </div><hr>
            </div>
            <?php } ?>
            <div style="text-align: center;">
              <input type="submit" class="btn btn-primary icon-btn" name="submit" value="SIMPAN">
              <input type="button" class="btn btn-default" value="BATAL" onclick="history.back(-1)"">
            </div>
          </div>          
        </form>
      </div>
    </div>
  </div>
</div>
</div>