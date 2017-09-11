<?php
if($page=='hadiah_page')
{
  ?>
  <div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2 class="panel-title"> <b>Data Hadiah</b></h2>
        <ul class="panel-controls" style="margin-top: 2px;">
        <li>
        <a href="<?= base_url().'data/hadiah/input/';?>" title="Tambah Hadiah"><span class="glyphicon glyphicon-plus"></span></a>
        </li>
      </ul>
    </div>
    <div class="panel-body">
      <table id="sampleTable3" class="table datatable">
      <thead>
        <tr>
          <th style="width: 50px;">#</th>
          <th>Nama Hadiah</th>
          <th style="text-align: center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php

        $no = 1;
        foreach($hadiah as $field_hadiah){
          ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $field_hadiah->nama_hadiah; ?></td>
            <td><center><a href="<?=base_url().'data/hadiah/delete/'.$field_hadiah->id_hadiah;?>" class="btn btn-primary"><i class="fa fa-trash-o"></i></a><a href="<?=base_url().'data/hadiah/edit/'.$field_hadiah->id_hadiah;?>" class="btn btn-default"><i class="fa fa-edit"></i></a></center> </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>

<?php
}
elseif($page=='hadiah_input_page')
{
  ?>
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
				<h2 class="panel-title"> <b>Tambah Hadiah</b></h2>
			</div>
			<div class="panel-body">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<form action="<?= base_url().'data/hadiah/input/action' ?>" method="POST" onsubmit="return validasi(this);" name="form">
						<div class="form-group">
							<label class="control-label">Nama Hadiah</label>
							<input type="text" placeholder="Masukan Nama Hadiah" name="form_nm_hadiah" require onkeyup="return text(this);" class="form-control" autofocus="">
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary icon-btn" name="submit" value="SIMPAN">
							<input type="button" class="btn btn-default icon-btn" onclick="history.back(-1)" value="BATAL">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
  <?php
}
elseif($page=='hadiah_update_page')
{
  ?>
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
        <h2 class="panel-title"> <b>Edit Hadiah</b></h2>
      </div>
      <div class="panel-body">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <?php foreach ($hadiah as $field_hadiah) { ?>
          <form action="<?=base_url().'data/hadiah/action'?>" method="POST" onsubmit="return validasi(this)" >
            <div class="form-group">
              <input name="form_id_hadiah" type="hidden" class="form-control" focus value="<?php echo $field_hadiah->id_hadiah; ?>">
            </div>
            <div class="form-group">
              <label class="control-label">Nama Hadiah</label>
              <input name="form_nm_hadiah" id="c" type="text" placeholder="Nama Hadiah" class="form-control" autofocus="" onkeyup="return text(this);" focus value="<?php echo  $field_hadiah->nama_hadiah; ?>">
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

<?php
}
?>