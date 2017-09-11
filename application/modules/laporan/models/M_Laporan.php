<?php

class M_Laporan extends CI_Model
{

	function yearly_transaction($year)
	{
		$kurniajaya	= $this->load->database('kurniajaya', TRUE);

		$query 	= "SELECT *
		FROM transaksi
		WHERE LEFT(tgl_transaksi,4) =  '$year'";
		
		return $kurniajaya->query($query);
	}

	function monthly_transaction($month)
	{
		$kurniajaya	= $this->load->database('kurniajaya', TRUE);

		$query 	= "SELECT *
		FROM transaksi
		WHERE LEFT(tgl_transaksi,7) =  '$month'";
		
		return $kurniajaya->query($query);
	}

	function daily_transaction($day)
	{
		$kurniajaya	= $this->load->database('kurniajaya', TRUE);

		$query 	= "SELECT *
		FROM transaksi
		WHERE tgl_transaksi =  '$day'";
		
		return $kurniajaya->query($query);
	}

	function yearly_barang($year)
	{
		$kurniajaya	= $this->load->database('kurniajaya', TRUE);

		$query 	= "SELECT detail_transaksi.id_barang, barang.nm_barang, barang.quantity, SUM( detail_transaksi.qty ) AS qty
		FROM detail_transaksi
		INNER JOIN barang ON detail_transaksi.id_barang = barang.id_barang
		WHERE SUBSTRING( detail_transaksi.timestmp, 1, 4 ) =  '$year'
		GROUP BY detail_transaksi.id_barang";
		
		return $kurniajaya->query($query);
	}

	function monthly_stok_barang($month)
	{
		$kurniajaya	= $this->load->database('kurniajaya', TRUE);

		$query 	= "SELECT detail_transaksi.id_barang, 
		barang.nm_barang,
		(SUM( detail_transaksi.qty ) + barang.quantity) AS quantity
		FROM detail_transaksi
		INNER JOIN barang ON detail_transaksi.id_barang = barang.id_barang
		WHERE (SUBSTRING( detail_transaksi.timestmp, 1, 7 ) BETWEEN  '$month' AND  '2100-12')
		GROUP BY detail_transaksi.id_barang";

		return $kurniajaya->query($query);
	}

	function monthly_barang($month)
	{
		$kurniajaya	= $this->load->database('kurniajaya', TRUE);

		$query 	= "SELECT detail_transaksi.id_barang, 
		barang.nm_barang,
		SUM( detail_transaksi.qty ) AS qty
		FROM detail_transaksi
		INNER JOIN barang ON detail_transaksi.id_barang = barang.id_barang
		WHERE SUBSTRING( detail_transaksi.timestmp, 1, 7 ) =  '$month'
		GROUP BY detail_transaksi.id_barang";

		return $kurniajaya->query($query);
	}

	function daily_stok_barang($day)
	{
		$kurniajaya	= $this->load->database('kurniajaya', TRUE);

		$query 	= "SELECT detail_transaksi.id_barang, 
		barang.nm_barang,
		(SUM( detail_transaksi.qty ) + barang.quantity) AS quantity
		FROM detail_transaksi
		INNER JOIN barang ON detail_transaksi.id_barang = barang.id_barang
		WHERE (SUBSTRING( detail_transaksi.timestmp, 1, 10 ) BETWEEN  '$day' AND  '2100-12-30')
		GROUP BY detail_transaksi.id_barang";

		return $kurniajaya->query($query);
	}

	function daily_barang($day)
	{
		$kurniajaya	= $this->load->database('kurniajaya', TRUE);

		$query 	= "SELECT detail_transaksi.id_barang, 
		barang.nm_barang,
		SUM( detail_transaksi.qty ) AS qty
		FROM detail_transaksi
		INNER JOIN barang ON detail_transaksi.id_barang = barang.id_barang
		WHERE SUBSTRING( detail_transaksi.timestmp, 1, 10 ) =  '$day'
		GROUP BY detail_transaksi.id_barang";

		return $kurniajaya->query($query);
	}

}

/* --- END OF FILE --- */
/* --- ©2017 Firas Luthfi Dwiyansyah --- */