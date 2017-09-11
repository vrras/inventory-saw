<?php

class M_Query extends CI_Model
{

	function insert_data($table,$data)
	{
		$kurniajaya	= $this->load->database('kurniajaya', TRUE);

		return $kurniajaya->insert($table,$data);
	}

	function select_all_data($table)
	{
		$kurniajaya	= $this->load->database('kurniajaya', TRUE);

		return $kurniajaya->get($table);
	}

	function select_condition($field,$table,$condition)
	{
		$kurniajaya	= $this->load->database('kurniajaya', TRUE);

		$kurniajaya->select($field);
		$kurniajaya->from($table);
		$kurniajaya->where($condition);

		return $kurniajaya->get();
	}

	function select_join($field,$table,$join_table,$key,$order)
	{
		$kurniajaya	= $this->load->database('kurniajaya', TRUE);

		$kurniajaya->select($field);
		$kurniajaya->from($table);
		$kurniajaya->join($join_table,$key);
		$kurniajaya->order_by($order,"ASC");

		return $kurniajaya->get();
	}

	function select_3join($field,$table,$join_table1,$join_table2,$join_table3,$key1,$key2,$key3,$order)
	{
		$kurniajaya	= $this->load->database('kurniajaya', TRUE);

		$kurniajaya->select($field);
		$kurniajaya->from($table);
		$kurniajaya->join($join_table1,$key1,'left');
		$kurniajaya->join($join_table2,$key2,'left');
		$kurniajaya->join($join_table3,$key3,'left');
		$kurniajaya->order_by($order,"ASC");

		return $kurniajaya->get();
	}

	function select_joinleft($field,$table,$join_table,$key,$condition)
	{
		$kurniajaya	= $this->load->database('kurniajaya', TRUE);

		$kurniajaya->select($field);
		$kurniajaya->from($table);
		$kurniajaya->join($join_table,$key,'left');
		$kurniajaya->where($condition);

		return $kurniajaya->get();
	}

	function select_joinleftorder($field,$table,$join_table,$key,$order)
	{
		$kurniajaya	= $this->load->database('kurniajaya', TRUE);

		$kurniajaya->select($field);
		$kurniajaya->from($table);
		$kurniajaya->join($join_table,$key,'left');
		$kurniajaya->order_by($order,"ASC");

		return $kurniajaya->get();
	}

	function select_max($field,$as,$table,$conditon)
	{
		$kurniajaya	= $this->load->database('kurniajaya', TRUE);

		$kurniajaya->select_max($field,$as);
		$kurniajaya->from($table);
		$kurniajaya->where($conditon);

		return $kurniajaya->get();
	}

	function select_order($field,$table,$order,$sort)
	{
		$kurniajaya	= $this->load->database('kurniajaya', TRUE);

		$kurniajaya->order_by($order,$sort);
		$kurniajaya->select($field);
		$kurniajaya->from($table);
		
		return $kurniajaya->get();
	}

	function update_data($table,$value,$condition)
	{
		$kurniajaya	= $this->load->database('kurniajaya', TRUE);
		
		$kurniajaya->where($condition);
		$kurniajaya->update($table,$value);
	}

	function delete_data($condition,$table)
	{
		$kurniajaya	= $this->load->database('kurniajaya', TRUE);

		$kurniajaya->where($condition);
		$kurniajaya->delete($table);
	}

	function select_limit($field,$table)
	{
		$kurniajaya	= $this->load->database('kurniajaya', TRUE);

		$kurniajaya->select($field);
		$kurniajaya->from($table);
		$kurniajaya->order_by('id_pelanggan','DESC');
		$kurniajaya->limit(1);  

		return $kurniajaya->get();
	}

	function buat_kode(){   
		$kurniajaya	= $this->load->database('kurniajaya', TRUE);

		$kurniajaya->select('RIGHT(transaksi.id_transaksi,2) as kode', FALSE);
		$kurniajaya->order_by('id_transaksi','DESC');    
		$kurniajaya->limit(1);     
		$query = $kurniajaya->get('transaksi');      //cek dulu apakah ada sudah ada kode di tabel.    
		if($query->num_rows() <> 0){       
		//jika kode ternyata sudah ada.      
			$data = $query->row();      
			$kode = intval($data->kode) + 1;     
		}
		else{       
		//jika kode belum ada      
			$kode = 1;     
		}
		$kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);    
		$kodejadi = "TRKJ_".$kodemax;     
		return $kodejadi;  
	}
}

/* --- END OF FILE --- */
/* --- ©2017 Firas Luthfi Dwiyansyah --- */