<link rel="stylesheet" type="text/css" href="<?=asset_url().'css/print_laporan.css'?>"> 
<?php
if($page == 'print_year')
{
	?>
	<body onload="print()">
		<page size="A4">
			<table id="sampleTable3" class="table datatable">
				<thead>
					<tr>
						<th>#</th>
						<th>ID Barang</th>
						<th>Nama Barang</th>
						<th>Stok</th>
						<th>Terjual</th>
						<th>Sisa</th>
					</tr>
				</thead>
				<tbody>
					<?php

					$no = 1;
					foreach($trx as $field_trx){ 
						?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $field_trx->id_barang; ?></td>
							<td><?php echo $field_trx->nm_barang;?></td>
							<td><?php echo $field_trx->quantity+$field_trx->qty;?></td>
							<td><?php echo $field_trx->qty;?></td>
							<td><?php echo $field_trx->quantity;?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</page>
		</body>
		<?php
	}
	elseif ($page == 'print_month') 
	{
		foreach ($trx_stok as $field_stok) {
			$id_barang[]  = $field_stok->id_barang;
			$nm_barang[]  = $field_stok->nm_barang;
			$quantity[]   = $field_stok->quantity;
		}

		foreach ($trx_month as $field_trx) {
			$id_barang1[]  = $field_trx->id_barang;
			$nm_barang1[]  = $field_trx->nm_barang;
			$qty[]         = $field_trx->qty;
		}

		if(!empty($id_barang1))
		{
			$tampung = array_intersect($id_barang, $id_barang1);

			foreach ($tampung as $key => $value) {
				$a[]  = $key;
			}
		}
		else
		{

		}

		?>
		<body onload="print()">
			<page size="A4">
				<table id="sampleTable3" class="table datatable">
					<thead>
						<tr>
							<th>#</th>
							<th>ID Barang</th>
							<th>Nama Barang</th>
							<th>Stok</th>
							<th>Terjual</th>
							<th>Sisa</th>
						</tr>
					</thead>
					<tbody>
						<?php

						if(!empty($id_barang1))
						{
							$no = 1;
							$j  = 0;
							for($i = $a[$j]; $i <= end($a); $i++){ 
								?>

								<tr>
									<td><?php echo $no++; ?></td>
									<td><?php echo $id_barang[$i]; ?></td>
									<td><?php echo $nm_barang[$i];?></td>
									<td><?php echo $quantity[$i];?></td>
									<td><?php echo !empty($qty[$i])? $qty[$i] : $qty[$j]?></td>
									<td><?php echo !empty($qty[$i])? $quantity[$i]-$qty[$i] : $quantity[$i]-$qty[$j]?></td>
								</tr>

								<?php
							}
						}
						else
						{
							?>


							<?php
						}

						?>

					</tbody>
				</table>
			</page>
		</body>
		<?php
	}
	else
	{

		foreach ($trx_stok as $field_stok) {
			$id_barang[]  = $field_stok->id_barang;
			$nm_barang[]  = $field_stok->nm_barang;
			$quantity[]   = $field_stok->quantity;
		}

		foreach ($trx_day as $field_trx) {
			$id_barang1[]  = $field_trx->id_barang;
			$nm_barang1[]  = $field_trx->nm_barang;
			$qty[]         = $field_trx->qty;
		}

		if(!empty($id_barang1))
		{
			$tampung = array_intersect($id_barang, $id_barang1);

			foreach ($tampung as $key => $value) {
				$a[]  = $key;
			}
		}
		else
		{

		}
		?>

		<body onload="print()">
			<page size="A4">
				<table id="sampleTable3" class="table datatable">
					<thead>
						<tr>
							<th>#</th>
							<th>ID Barang</th>
							<th>Nama Barang</th>
							<th>Stok</th>
							<th>Terjual</th>
							<th>Sisa</th>
						</tr>
					</thead>
					<tbody>
						<?php

						if(!empty($id_barang1))
						{
							$no = 1;
							$j  = 0;

							for($i = $a[$j]; $i <= end($a); $i++){ 
								if($i!=$a[$j])
								{
									continue;
								}
								?>

								<tr>
									<td><?php echo $no++; ?></td>
									<td><?php echo $id_barang[$i]; ?></td>
									<td><?php echo $nm_barang[$i];?></td>
									<td><?php echo $quantity[$i];?></td>
									<td><?php echo !empty($qty[$i])? $qty[$j] : $qty[$j]?></td>
									<td><?php echo !empty($qty[$i])? $quantity[$i]-$qty[$j] : $quantity[$i]-$qty[$j]?></td>
								</tr>

								<?php
								$j = $j+1;
							}
						}
						else
						{
							?>


							<?php
						}

						?>

					</tbody>
				</table>
			</page>
		</body>

		<?php
	}
	?>