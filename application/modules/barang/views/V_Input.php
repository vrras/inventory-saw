<script type="text/javascript">
	function validasi(form){
		if (form.a.value.trim()=='') {
			alert('Nama barang mohon di isi terlebih dahulu');
			form.a.focus();
			return false;
		}
		if (form.b.value.trim()=='') {
			alert('Quantity belum diisi mohon di isi terlebih dahulu');
			form.b.focus();
			return false;
		}
		if (form.c.value.trim()=='') {
			alert('Harga belum diisi mohon di isi terlebih dahulu');
			form.c.focus();
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
				<h2 class="panel-title"> <b>Tambah Barang</b></h2>                            
			</div>
			<div class="panel-body">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<form action="<?= base_url().'data/barang/input/action' ?>" method="POST" onsubmit="return validasi(this);" name="form">
						<div class="form-group">
							<label class="control-label">Nama Barang</label>
							<input type="text" placeholder="Masukan Nama Barang" name="form_nm_barang" id="a" onkeyup="return text(this);" class="form-control" autofocus="">
						</div>
						<div class="form-group">
							<label class="control-label">Quantity</label>
							<input type="text" name="form_quantity" placeholder="Masukan Quantity" id="b" onkeyup="return angka(this);" class="form-control">
						</div>
						<div class="form-group">
							<label class="control-label">Harga</label>
							<div class="input-group"><span class="input-group-addon">Rp.</span>
								<input type="text" class="form-control" name="form_harga" placeholder="Masukan Harga" id="c" onkeyup="return angka(this);">
							</div>
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
