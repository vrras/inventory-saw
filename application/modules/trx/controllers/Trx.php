<?php

class Trx extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('query/M_Query');
		date_default_timezone_set('Asia/Jakarta');
		
		if($this->sign_validation->signin_valid())
		{
			redirect(base_url());
		}
		
	}

	function transaksi_page()
	{
		// --- Barang ---
		$table 				= "barang";		

		$data['barang'] 	= $this->M_Query->select_all_data($table)->result();

		// --- Keranjang ---
		$field 				= "*";
		$table2 			= "keranjang";
		$join_table 		= "barang";
		$key 				= "keranjang.id_barang = barang.id_barang";
		$order 				= "keranjang.timestmp";

		$data['trx'] 		= $this->M_Query->select_join($field,$table2,$join_table,$key,$order)->result();

		$data['level']		= $this->session->userdata("level");
		$data['title']		= 'Transaksi';

		$this->template->display('trx/V_Transaksi',$data);
	}

	function transaksi_page_all()
	{
		$data['page'] 	= "all";

		// --- Transaksi
		$table 				= "transaksi";		

		$data['transaksi'] 	= $this->M_Query->select_all_data($table)->result();			

		$data['level']		= $this->session->userdata("level");
		$data['title']		= 'Transaksi';

		$this->template->display('trx/V_Transaksi_All',$data);
	}

	function transaksi_page_pelanggan()
	{
		$tot_bayar 	= $this->input->post('form_total');
		// --- Barang ---
		$table 				= "barang";		

		$data['barang'] 	= $this->M_Query->select_all_data($table)->result();

		// --- Keranjang ---
		$field 				= "*";
		$table2 			= "keranjang";
		$join_table 		= "barang";
		$key 				= "keranjang.id_barang = barang.id_barang";
		$order 				= "keranjang.timestmp";

		$data['trx'] 		= $this->M_Query->select_join($field,$table2,$join_table,$key,$order)->result();

		if(empty($tot_bayar)){
			echo "<script>alert('Tidak ada transaksi');</script>";
			redirect(base_url().'trx/penjualan','refresh');
		}else{
		// --- Pelanggan ---
			$id_pelanggan 		= $this->input->post('form_id_pelanggan');
			$table3 			= 'pelanggan';
			$condition 			= array('id_pelanggan' => $id_pelanggan );
			$condition2			= array('no_telpon' => $id_pelanggan );

			if($this->M_Query->select_condition($field,$table3,$condition)->num_rows()>0){
				$data['pelanggan'] = $this->M_Query->select_condition($field,$table3,$condition)->result();
			}elseif($this->M_Query->select_condition($field,$table3,$condition2)->num_rows()>0){
				$data['pelanggan'] = $this->M_Query->select_condition($field,$table3,$condition2)->result();
			}else{
				$data['pelanggan'] 	= "baru";
			}

			$data['level']		= $this->session->userdata("level");
			$data['title']		= 'Transaksi';

			$this->template->display('trx/V_Transaksi',$data);
		}
	}

	function transaksi_input_keranjang()
	{
		$id_barang 		= $this->input->post('id_barang');
		$condition 		= array('id_barang' => $id_barang );
		$field 			= "*";
		$table 			= "barang";
		$row			= $this->M_Query->select_condition($field,$table,$condition)->result();
		
		foreach ($row as $field_barang) {
			$stok 			= $field_barang->quantity;
			$harga 			= $field_barang->harga;
		}		
		
		$qty 			= $this->input->post('qty');
		$dsc 			= $this->input->post('disc');
		$now			= date('Y-m-d H:i:s');	

		$table2 		= "keranjang";
		$sql 			= $this->M_Query->select_condition($field,$table2,$condition)->result();
		
		foreach ($sql as $field_keranjang) {
			$quan 			= $field_keranjang->qty;	
		}

		if($qty>$stok)
		{
			redirect(base_url().'trx/penjualan');	
		}elseif($qty=='0')
		{
			redirect(base_url().'trx/penjualan');
		}else
		{
			if($as = $this->M_Query->select_condition($field,$table2,$condition)->num_rows()>0)
			{
				$new_quan 	= $quan + $qty;
				$value 		= array('qty' => $new_quan );

				$sql_ker 	= $this->M_Query->update_data($table2,$value,$condition);
				redirect(base_url().'trx/penjualan');
			}else{
				$data 		= array('id_barang' => $id_barang, 'harga' => $harga, 'disc' => $dsc, 'qty' => $qty, 'timestmp' => $now, 'del' => '1');

				$this->M_Query->insert_data($table2,$data);
				redirect(base_url().'trx/penjualan');
			}
		}
	}

	function transaksi_batal_keranjang()
	{		
		$id 		= $this->uri->segment(4);	
		$table 		= 'keranjang';
		$condition 	= array('id_barang' => $id );
		
		$this->M_Query->delete_data($condition,$table);
		redirect(base_url().'trx/penjualan');
	}

	function transaksi_batalall_keranjang()
	{		
		$table 		= 'keranjang';
		$condition 	= array('del' => '1' );
		
		$this->M_Query->delete_data($condition,$table);
		redirect(base_url().'trx/penjualan');
	}

	function transaksi_simpan_penjualan()
	{
		$total_harga 	= $this->input->post('form_total');
		$id_pelanggan	= $this->input->post('form_id_pelanggan');	
		$jum_bayar 		= $this->input->post('form_jmlbayar');	
		$status 		= $this->input->post('form_status');
		$now			= date('Y-m-d H:i:s');

		// --- Tampil Keranjang ---
		$field 			= '*';
		$table 			= 'keranjang';
		$condition 		= array('del' => '1' );

		$keranjang		= $this->M_Query->select_condition($field,$table,$condition)->num_rows();
		$keranjang2		= $this->M_Query->select_condition($field,$table,$condition)->result();

		// --- Cek Member ---
		$field 			= '*';
		$table 			= 'pelanggan';
		$condition 		= array('id_pelanggan' => $id_pelanggan );

		$member		 = $this->M_Query->select_condition($field,$table,$condition)->num_rows();
		$member_re	 = $this->M_Query->select_condition($field,$table,$condition)->result();
		
		if($keranjang>0)
		{
			$id_transaksi 	= $this->M_Query->buat_kode();
			$tot_bayar 		= 0;

			$tgl = date('Y-m-d'); 

			foreach ($keranjang2 as $field_keranjang) {
				$harga_disc 	= $field_keranjang->harga - ($field_keranjang->harga * $field_keranjang->disc) / 100;
				$sub_total 		= $harga_disc * $field_keranjang->qty;

				$tot_bayar 	=  $tot_bayar + $sub_total;
			}
		}

		if($member>0)
		{
			foreach ($member_re as $field_memberre) {
				$id_pel 		= $field_memberre->id_pelanggan;
				$nama_pelanggan = $field_memberre->nama_pelanggan;
			}
		}else
		{
			$id_pelanggan 	= "";
			$nm_pelanggan	= $this->input->post('form_nama');			
			$status_pel		= "no_member";
			$table 			= 'pelanggan';
			$field 			= '*';

			$data 		= array('id_pelanggan' => $id_pelanggan, 'nama_pelanggan' => $nm_pelanggan, 'status' => $status_pel);

			$this->M_Query->insert_data($table,$data);

			$pelanggan_baru 	= $this->M_Query->select_limit($field,$table)->result();
			foreach ($pelanggan_baru as $field_pelbaru) {
				$id_pel  			= $field_pelbaru->id_pelanggan;
				$nama_pelanggan		= $field_pelbaru->nama_pelanggan;	
			}
		}
		if(($tot_bayar <= $jum_bayar) OR ($status == 'credit'))
		{
			$table 		= "transaksi";
			$data 		= array('id_transaksi' => $id_transaksi, 'id_pelanggan' => $id_pel, 'nama_pelanggan' => $nama_pelanggan, 'tgl_transaksi' => $tgl, 'status' => $status, 'total_harga' => $total_harga, 'bayar' => $jum_bayar, 'timestmp' => $now );

			$this->M_Query->insert_data($table,$data);

			$table2 		= "detail_transaksi";
			foreach ($keranjang2 as $field_keranjang2) {
				$data2 		= array('id_transaksi' => $id_transaksi, 'id_barang' => $field_keranjang2->id_barang, 'qty' => $field_keranjang2->qty ,'harga' => $field_keranjang2->harga,'disc' => $field_keranjang2->disc,'timestmp' => $field_keranjang2->timestmp );

				$this->M_Query->insert_data($table2,$data2);
			}

		}
		
		redirect(base_url().'trx/penjualan/detail/'.$id_transaksi);
	}

	function transaksi_delete_action()
	{
		$id 		= $this->uri->segment(4);	
		$table 		= 'transaksi';
		$condition 	= array('id_transaksi' => $id );
		
		$this->M_Query->delete_data($condition,$table);
		redirect(base_url().'trx/penjualan/all');
	}

	function transaksi_page_detail()
	{
		$data['page'] 		= "detail";
		$id 				= $this->uri->segment(4);

		// --- Transaksi ---
		$field 				= "*";
		$table 				= "transaksi";
		$condition 		 	= array('id_transaksi' => $id );

		$data['transaksi'] 	= $this->M_Query->select_condition($field,$table,$condition)->result();

		// --- Detail Transaksi ---
		$field2 		= "detail_transaksi.*, barang.nm_barang, barang.satuan";
		$table2 		= "detail_transaksi";
		$join_table 	= "barang";
		$key 		 	= "detail_transaksi.id_barang = barang.id_barang";
		$condition 		= array('detail_transaksi.id_transaksi' => $id );

		$data['detail'] 	= $this->M_Query->select_joinleft($field2,$table2,$join_table,$key,$condition)->result();

		$data['level']		= $this->session->userdata("level");
		$data['title']		= 'Transaksi';

		$this->template->display('trx/V_Transaksi_All',$data);
	}

	function transaksi_cetak()
	{
		// --- Transaksi ---
		$id 				= $this->uri->segment(4);
		$field 				= "*";
		$table 				= "transaksi";
		$condition 			= array('id_transaksi' => $id );

		$data['transaksi'] 	= $this->M_Query->select_condition($field,$table,$condition)->result();

		// --- Detail Transaksi ---
		$field2 		= "detail_transaksi.*, barang.nm_barang, barang.satuan";
		$table2 		= "detail_transaksi";
		$join_table 	= "barang";
		$key 		 	= "detail_transaksi.id_barang = barang.id_barang";
		$condition 		= array('detail_transaksi.id_transaksi' => $id );

		$data['detail'] 	= $this->M_Query->select_joinleft($field2,$table2,$join_table,$key,$condition)->result();

		$this->load->view('trx/Cetak',$data);
	}

	//SELECT detail_transaksi.*, barang.nm_barang, barang.satuan FROM detail_transaksi LEFT JOIN barang ON detail_transaksi.id_barang = barang.id_barang WHERE detail_transaksi.id_transaksi = 'TRKJ_0010'
}