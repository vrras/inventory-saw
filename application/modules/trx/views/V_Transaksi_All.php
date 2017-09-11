<?php if($page=="all"){ ?>

<div class="col-md-12">
	<div class="panel panel-default">     
		<div class="panel-heading">
			<h2 class="panel-title"> <b>Data Semua Transaksi</b></h2>
		</div>

		<div class="panel-body">

			<table id="sampleTable3" class="table datatable">
				<thead>
					<tr class='w3-yellow'>
						<th>NO</th>
						<th>ID TRANSAKSI</th>
						<th>ID PEL.</th>
						<th>NAMA PELANGGAN</th>
						<th>TGL. TRANSAKSI</th>
						<th>TOTAL</th>
						<th>STATUS</th>
						<th>#</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$no 		= 1;
					foreach ($transaksi as $field_transaksi) { ?>
					<tr>
						<td><?=$no++?></td>
						<td><a class="w3-text-blue w3-hover-text-red" href="<?=base_url().'trx/penjualan/detail/'.$field_transaksi->id_transaksi?>"><?=$field_transaksi->id_transaksi?></a></td>
						<td><?=$field_transaksi->id_pelanggan?></td>
						<td><?=$field_transaksi->nama_pelanggan?></td>
						<td><?=$field_transaksi->tgl_transaksi?></td>
						<td><?=$field_transaksi->total_harga?></td>
						<td><?=$field_transaksi->status?></td>
						<td>
							<a href='<?=base_url().'trx/penjualan/delete/'.$field_transaksi->id_transaksi?>' onclick="return confirm('Yakin ingin membatalkan?');"><button class="btn btn-primary" style="color: white" type="submit"><i class="glyphicon glyphicon-trash"></i></button></a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div> 
</div>

<?php } elseif($page=="detail") { ?>

<?php foreach ($transaksi as $field_transaksi) {  ?>
<div class="col-md-12">

	<div class="panel panel-default">

		<div class="panel-heading">
			<h3 class="panel-title">Printout Penjualan</h3>			
		</div>

		<div class="panel-body">
			<table class="table">
				<thead>
					<th style="background-color: #F5A9A9; color: black; padding-top: 15px; padding-bottom: 15px; font-size: 11px;" colspan="3"><i>Jika terjadi kesalahan harap lapor Administrator.</i></th>
					<tr style='border-bottom:1px dashed #ccc;'>
						<td width='150px'>ID Transaksi</td>
						<td width='10px'>:</td>
						<td><b><?=$field_transaksi->id_transaksi?></b></td>
					</tr>

					<tr style='border-bottom:1px dashed #ccc;'>
						<td>Nama / ID Pelanggan</td>
						<td>:</td>
						<td><b><?= $field_transaksi->nama_pelanggan?> / <?php echo !empty($field_transaksi->id_pelanggan) ? $field_transaksi->id_pelanggan : "-"; ?></b></td>
					</tr>

					<tr style='border-bottom:1px dashed #ccc;'>
						<td>Tanggal Transaksi</td>
						<td>:</td>
						<td><b><?= $field_transaksi->tgl_transaksi?></b></td>
					</tr>

					<tr style='border-bottom:1px dashed #ccc;'>
						<td>Status</td>
						<td>:</td>
						<td><b><?= strtoupper($field_transaksi->status)?></b></td>
					</tr>
				</thead>				
			</table>    
		</div>
	</div>

	<div class="panel panel-default">

		<div class="panel-heading">
			<h3 class="panel-title">Detail Barang</h3>			
		</div>

		<div class="panel-body">
			<table id="sampleTable3" class="table datatable">
				<thead>
					<tr>
						<th>#</th>
						<th>KODE</th>
						<th>BARANG</th>
						<th>HARGA</th>
						<th>DISC.</th>
						<th>SUB TOTAL</th>
					</tr>
				</thead>
				<?php
				$sub_total = 0;
				$total = 0;
				$no = 1;

				foreach ($detail as $field_detail) { 
					$harga_disc = $field_detail->harga - (($field_detail->harga * $field_detail->disc) / 100);
					$sub_total = $harga_disc * $field_detail->qty;

					$total = $total + $sub_total;
					?>		
					<tbody> 						
						<tr>
							<td><?=$no++?></td>
							<td><?=$field_detail->id_barang?></td>
							<td><?=$field_detail->nm_barang?></td>
							<td>Rp. <?=number_format($field_detail->harga,0,'.','.')?> X <?php echo $field_detail->qty."&nbsp"; echo $field_detail->satuan?></td>
							<td><?=number_format($field_detail->disc,0)?>%</td>
							<td>Rp. <?=number_format($sub_total,2,',','.')?></td>
						</tr>					
					</tbody>
					<?php
				} 

				$sisa = $field_transaksi->bayar - $total;
				?>
				<tfoot>
					<tr>
						<td colspan='5'>Total Bayar</b></td>
						<td>Rp. <?=number_format($total,2,',','.')?></td>
					</tr>
					<tr style="background-color: #D0F5A9;">
						<td colspan='5'><b>Pembayaran</b></td>
						<td><b>Rp. <?=number_format($field_transaksi->bayar,2,',','.')?></b></td>
					</tr>
					<tr style="background-color: #F5A9A9;">
						<td colspan='5'><b>Kembali</b></td>
						<td><b>Rp. <?=number_format($sisa,2,',','.')?></b></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
	<p>
		<a href="<?=base_url().'trx/penjualan/all'?>"><button class='btn btn-danger'><i class='fa fa-mail-reply'></i> Back</button></a>
		<a href='<?=base_url().'trx/penjualan'?>'><button class='btn btn-info'><i class='fa fa-shopping-cart'></i> Transaksi Baru</button></a>
		<a href='<?=base_url().'trx/penjualan/cetak/'.$field_transaksi->id_transaksi?>' target='_blank'><button class='btn btn-warning'><i class='fa fa-print'></i> Cetak Kwitansi</button></a>
	</p>	
</div>
<?php } ?>
<?php } ?>