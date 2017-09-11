<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>PRINTOUT</title>
	
	<link rel='stylesheet' type='text/css' href='<?=asset_url();?>css/style.css' />
	<link rel='stylesheet' type='text/css' href='<?=asset_url();?>css/print.css' media="print" />
	<script type='text/javascript' src='<?=asset_url();?>js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='<?=asset_url();?>js/example.js'></script>

</head>

<body onload="print()">

	<div id="page-wrap">

		<div id="header">INVOICE</div>
		
		<div id="identity">

			<div id="address">Jalan Ahmad Yani No. 36 A 
			<br>Kuningan, Jawa Bara 
			<br><br>Phone: (0741) 670523</div>

				<div id="logo">

					<div id="logoctr">
						<a href="javascript:;" id="change-logo" title="Change logo">Change Logo</a>
						<a href="javascript:;" id="save-logo" title="Save changes">Save</a>
						|
						<a href="javascript:;" id="delete-logo" title="Delete logo">Delete Logo</a>
						<a href="javascript:;" id="cancel-logo" title="Cancel changes">Cancel</a>
					</div>

					<div id="logohelp">
						<input id="imageloc" type="text" size="50" value="" /><br />
						(max width: 540px, max height: 100px)
					</div>
					<img id="image" width="300px" height="100px" src="<?=asset_url();?>Logo Kurnia jaya.png" alt="logo" />
				</div>

			</div>

			<div style="clear:both"></div>

			<div id="customer">

			<?php foreach ($transaksi as $field_transaksi) { ?>
				<div id="customer-title">Kepada Yth,
					<br><?=$field_transaksi->nama_pelanggan?> / <?php echo !empty($field_transaksi->id_pelanggan) ? $field_transaksi->id_pelanggan : "-"; ?>
				</div>
			<?php } ?>

					<table id="meta">
						<tr>
							<td class="meta-head">Invoice #</td>
							<?php foreach ($transaksi as $field_transaksi) { ?>
								<td><div><?=$field_transaksi->id_transaksi?></div></td>
							<?php } ?>
						</tr>
						<tr>
							<td class="meta-head">Date</td>
							<td><textarea id="date">December 15, 2009</textarea></td>
						</tr>

						<?php 
							$sub_total2 	= 0;
							$total_byr2 	= 0;
							$disc2 		= 0;
							$total2 		= 0;

							foreach ($detail as $field_detail) { 
								$disc2 		= $disc2 + ($field_detail->harga * $field_detail->qty * $field_detail->disc) / 100;
								$harga_disc2 = $field_detail->harga - (($field_detail->harga * $field_detail->disc) / 100);
								$sub_total2 	= $field_detail->harga * $field_detail->qty;
								$total_byr2 	= $total_byr2 + $sub_total2;			
							} 
							
							$total2 		= $total_byr2 - $disc2;
						?>

						<tr>
							<td class="meta-head">Amount Due</td>
							<td><div class="due">Rp. <?= number_format($total2,2,',','.')?></div></td>
						</tr>

					</table>

				</div>

				<table id="items">

					<tr>
						<th>#</th>
						<th>Code</th>
						<th>Item</th>
						<th>Unit Cost</th>
						<th>Quantity</th>
						<th>Disc</th>
						<th>Price</th>
					</tr>

					<?php 
					$sub_total 	= 0;
					$total_byr 	= 0;
					$disc 		= 0;
					$total 		= 0;
					$no=1;

					foreach ($detail as $field_detail) { 
						$disc 		= $disc + ($field_detail->harga * $field_detail->qty * $field_detail->disc) / 100;
						$harga_disc = $field_detail->harga - (($field_detail->harga * $field_detail->disc) / 100);
						$sub_total 	= $field_detail->harga * $field_detail->qty;
						$total_byr 	= $total_byr + $sub_total;					
					?>
					<tr class="item-row">
						<td align="center"><?=$no++?></td>
						<td align="center" width="10px"><div class="delete-wpr"><?= $field_detail->id_barang?></div></td>
						<td><?= $field_detail->nm_barang?></td>
						<td>Rp. <?= number_format($field_detail->harga,0,',','.')?></td>
						<td align="center"><?= $field_detail->qty?></td>
						<td align="center"><?= $field_detail->disc?></td>
						<td>Rp. <?= number_format($sub_total,2,',','.')?></td>
					</tr>
					<?php 
					} 
					
					$total 		= $total_byr - $disc;
					$sisa 		= $field_transaksi->bayar - $total;
					?>

					<tr>
						<td colspan="3" class="blank"> </td>
						<td colspan="3" class="total-line">Subtotal</td>
						<td class="total-value"><div id="subtotal">Rp. <?= number_format($total_byr,2,',','.')?></div></td>
					</tr>
					<tr>
						<td colspan="3" class="blank"> </td>
						<td colspan="3" class="total-line">Discount</td>
						<td class="total-value"><div id="total">Rp. <?= number_format($disc,2,',','.')?></div></td>
					</tr>
					<tr>

						<td colspan="3" class="blank"> </td>
						<td colspan="3" class="total-line">Total</td>
						<td class="total-value"><div id="total">Rp. <?= number_format($total,2,',','.')?></div></td>
					</tr>
					<tr>
						<td colspan="3" class="blank"> </td>
						<td colspan="3" class="total-line">Amount Paid</td>

						<td class="total-value">Rp. <?= number_format($field_transaksi->bayar,2,',','.')?></td>
					</tr>
					<tr>
						<td colspan="3" class="blank"> </td>
						<td colspan="3" class="total-line balance">Balance Due</td>
						<td class="total-value balance"><div class="due">Rp. <?= number_format($sisa,2,',','.')?></div></td>
					</tr>

				</table>

				<div id="terms">
					<h5>Terms</h5><p align="left">* Barang yang sudah dibeli tidak dapat dikembalikan<br>
				* Barang-barang yang diservice, apabila tidak diambil dalam jangka 3 bulan, resiko kehilangan bukan menjadi tanggung jawab kami</p>
				</div>

			</div>

		</body>

		</html>