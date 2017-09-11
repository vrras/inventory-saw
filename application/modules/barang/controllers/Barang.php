<?php

class Barang extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('query/M_Query');
		
		if($this->sign_validation->signin_valid())
		{
			redirect(base_url());
		}
		
	}

	function item_page()
	{
		$table 				= "barang";
		$data['barang'] 	= $this->M_Query->select_all_data($table)->result();

		$data['level']		= $this->session->userdata("level");
		$data['title']		= 'Data Barang';

		$this->template->display('barang/V_Barang',$data);	
	}

	function item_input_page()
	{
		$data['level']		= $this->session->userdata("level");
		$data['title']		= 'Data Barang';

		$this->template->display('barang/V_Input',$data);	
	}

	function item_input_action()
	{		
		$id_barang 	= "";
		$nm_barang	= $this->input->post('form_nm_barang');
		$quantity 	= $this->input->post('form_quantity');
		$harga 		= $this->input->post('form_harga');
		$table 		= 'barang';

		$data 		= array('id_barang' => $id_barang, 'nm_barang' => $nm_barang, 'quantity' => $quantity, 'harga' => $harga);

		$this->M_Query->insert_data($table,$data);

		redirect(base_url().'data/barang');
	}

	function item_update_page()
	{
		$id 				= $this->uri->segment(4);
		$field 				= "*";
		$table 				= "barang";
		$condition 			= array('id_barang' => $id );
		$data['barang'] 	= $this->M_Query->select_condition($field,$table,$condition)->result();

		$data['level']		= $this->session->userdata("level");
		$data['title']		= 'Data Barang';		

		$this->template->display('barang/V_Update',$data);	
	}

	function action_update()
	{
		$id_barang 	= $this->input->post('form_id_barang');
		$nm_barang	= $this->input->post('form_nm_barang');
		$quantity 	= $this->input->post('form_quantity');
		$harga 		= $this->input->post('form_harga');
		$table 		= 'barang';

		$value 		= array('nm_barang' => $nm_barang, 'quantity' => $quantity, 'harga' => $harga);
		$condition 	= array('id_barang' => $id_barang);

		$this->M_Query->update_data($table,$value,$condition);

		redirect(base_url().'data/barang');
	}

	function item_delete_action()
	{
		$id 			= $this->uri->segment(4);
		$table 			= "barang";
		$condition 		= array('id_barang' => $id );
		
		$data['barang'] = $this->M_Query->delete_data($condition,$table);

		redirect(base_url().'data/barang');
	}
}