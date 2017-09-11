<?php

class M_Penilaian extends CI_Model
{

	function criteria_one($lastmonth,$today)
	{
		$kurniajaya	= $this->load->database('kurniajaya', TRUE);

		$query 	= "SELECT transaksi.id_pelanggan, 
		transaksi.nama_pelanggan, 
		transaksi.tgl_transaksi, 
		transaksi.status, 
		SUM( transaksi.total_harga ) AS total_belanja, 
		pelanggan.status AS pelstatus
		FROM transaksi
		JOIN pelanggan
		ON transaksi.id_pelanggan= pelanggan.id_pelanggan
		WHERE ( SUBSTRING( transaksi.tgl_transaksi, 1, 7 ) 
		BETWEEN  '$lastmonth' AND  '$today' ) 
		AND pelanggan.status = 'member'
		GROUP BY id_pelanggan";

		return $kurniajaya->query($query);
	}

	function criteria_one_cash($lastmonth,$today,$id)
	{
		$kurniajaya	= $this->load->database('kurniajaya', TRUE);

		$query 	= "SELECT transaksi.id_pelanggan, 
		transaksi.nama_pelanggan, 
		transaksi.status, 
		pelanggan.status AS pelstatus
		FROM transaksi
		JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan
		WHERE (SUBSTRING( transaksi.tgl_transaksi, 1, 7 ) 
		BETWEEN  '$lastmonth' AND  '$today' )
		AND pelanggan.status =  'member'
		AND transaksi.id_pelanggan =  '$id' 
		AND transaksi.status = 'cash'";

		return $kurniajaya->query($query);
	}

	function criteria_one_credit($lastmonth,$today,$id)
	{
		$kurniajaya	= $this->load->database('kurniajaya', TRUE);

		$query 	= "SELECT transaksi.id_pelanggan, 
		transaksi.nama_pelanggan, 
		transaksi.status, 
		pelanggan.status AS pelstatus
		FROM transaksi
		JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan
		WHERE (SUBSTRING( transaksi.tgl_transaksi, 1, 7 ) 
		BETWEEN  '$lastmonth' AND  '$today' )
		AND pelanggan.status =  'member'
		AND transaksi.id_pelanggan =  '$id' 
		AND transaksi.status = 'credit'";

		return $kurniajaya->query($query);
	}

	function criteria_one_loyal($lastmonth,$today,$id)
	{
		$kurniajaya	= $this->load->database('kurniajaya', TRUE);

		$query 	= "SELECT transaksi.id_pelanggan, 
		transaksi.nama_pelanggan, 
		transaksi.status, 
		pelanggan.status AS pelstatus
		FROM transaksi
		JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan
		WHERE (SUBSTRING( transaksi.tgl_transaksi, 1, 7 ) 
		BETWEEN  '$lastmonth' AND  '$today' )
		AND pelanggan.status =  'member'
		AND transaksi.id_pelanggan =  '$id'";

		return $kurniajaya->query($query);
	}

	function get_benefitcost()
	{
		$kurniajaya	= $this->load->database('kurniajaya', TRUE);

		$query 	= "SELECT MIN(criteria1) AS cost1, 
		MIN(criteria2) AS cost2,
		MIN(criteria3) AS cost3,
		MAX(criteria1) AS benefit1,
		MAX(criteria2) AS benefit2,
		MAX(criteria3) AS benefit3
		FROM alternatif";

		return $kurniajaya->query($query);
	}

	function get_rangking()
	{
		$kurniajaya	= $this->load->database('kurniajaya', TRUE);

		$query 	= "SELECT * 
		FROM  alternatif 
		ORDER BY hasil_alternatif DESC";

		return $kurniajaya->query($query); 
	}

	function get_subkriteria($id)
	{
		$kurniajaya	= $this->load->database('kurniajaya', TRUE);

		$query 	= "SELECT * 
		FROM `subkriteria`
		WHERE id_kriteria = '$id'";

		return $kurniajaya->query($query); 
	}

	function transaksi_akhir()
	{
		$kurniajaya	= $this->load->database('kurniajaya', TRUE);

		$query 	= "SELECT SUBSTRING( tgl_transaksi, 1, 7 ) AS tgl
		FROM transaksi
		ORDER BY tgl_transaksi ASC ";

		return $kurniajaya->query($query); 
	}

	function delete_alternatif()
	{
		$kurniajaya	= $this->load->database('kurniajaya', TRUE);

		$query 	= "DELETE FROM alternatif WHERE 1";

		return $kurniajaya->query($query); 
	}

}

/* --- END OF FILE --- */
/* --- ©2017 Firas Luthfi Dwiyansyah --- */