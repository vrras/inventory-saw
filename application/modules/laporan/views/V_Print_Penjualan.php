<link rel="stylesheet" type="text/css" href="<?=asset_url().'css/print_laporan.css'?>"> 
<?php
if($page == 'print_year')
{
	?>
	<body onload="print()">
		<page size="A4">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>ID Transaksi</th>
						<th>ID Pelanggan</th>
						<th>Nama Pelanggan</th>
						<th>Status</th>
						<th>Total Harga</th>
						<th>Bayar</th>
					</tr>
				</thead>
				<tbody>
					<?php

					$no = 1;
					foreach($trx as $field_trx){ 
						?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $field_trx->id_transaksi; ?></td>
							<td><?php echo $field_trx->id_pelanggan;?></td>
							<td><?php echo $field_trx->nama_pelanggan;?></td>
							<td><?php echo $field_trx->status;?></td>
							<td><?php echo $field_trx->total_harga;?></td>
							<td><?php echo "Rp. "; echo number_format($field_trx->bayar,2,',','.');?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</page>
		</body>
		<?php
	}
	elseif ($page == 'print_month') {
		?>
		<body onload="print()">
			<page size="A4">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>ID Transaksi</th>
							<th>ID Pelanggan</th>
							<th>Nama Pelanggan</th>
							<th>Status</th>
							<th>Total Harga</th>
							<th>Bayar</th>
						</tr>
					</thead>
					<tbody>
						<?php

						$no = 1;
						foreach($trx as $field_trx){ 

							?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $field_trx->id_transaksi; ?></td>
								<td><?php echo $field_trx->id_pelanggan;?></td>
								<td><?php echo $field_trx->nama_pelanggan;?></td>
								<td><?php echo $field_trx->status;?></td>
								<td><?php echo $field_trx->total_harga;?></td>
								<td><?php echo "Rp. "; echo number_format($field_trx->bayar,2,',','.');?></td>
							</tr>

							<?php } ?>
						</tbody>
					</table>
				</page>
			</body>
			<?php
		}
		else
		{
			?>

			<body onload="print()">
				<page size="A4">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>ID Transaksi</th>
								<th>ID Pelanggan</th>
								<th>Nama Pelanggan</th>
								<th>Status</th>
								<th>Total Harga</th>
								<th>Bayar</th>
							</tr>
						</thead>
						<tbody>
							<?php

							$no = 1;
							foreach($trx as $field_trx){ 

								?>
								<tr>
									<td><?php echo $no++; ?></td>
									<td><?php echo $field_trx->id_transaksi; ?></td>
									<td><?php echo $field_trx->id_pelanggan;?></td>
									<td><?php echo $field_trx->nama_pelanggan;?></td>
									<td><?php echo $field_trx->status;?></td>
									<td><?php echo $field_trx->total_harga;?></td>
									<td><?php echo "Rp. "; echo number_format($field_trx->bayar,2,',','.');?></td>
								</tr>

								<?php } ?>
							</tbody>
						</table>
					</page>
				</body>

				<?php
			}
			?>