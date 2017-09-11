<?php

class Pelanggan extends CI_Controller
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

	function pelanggan_page()
	{
		$field 				= "*";
		$table 				= "pelanggan";
		$condition 			= array('status' => 'member' );
		$condition2 		= array('status' => 'no_member' );
		$data['member'] 	= $this->M_Query->select_condition($field,$table,$condition)->result();
		$data['pelanggan'] 	= $this->M_Query->select_condition($field,$table,$condition2)->result();

		$data['level']		= $this->session->userdata("level");
		$data['title']		= 'Data Pelanggan';

		$this->template->display('pelanggan/V_Pelanggan',$data);	
	}

	function pelanggan_input_page()
	{
		$data['level']		= $this->session->userdata("level");
		$data['title']		= 'Data Pelanggan';

		$this->template->display('pelanggan/V_Input',$data);	
	}

	function pelanggan_input_action()
	{		
		$id_pelanggan 	= "";
		$nm_pelanggan	= $this->input->post('form_nm_pelanggan');
		$nik 			= "";
		$jk 			= $this->input->post('form_jk');
		$hp 			= $this->input->post('form_hp');
		$alamat 		= $this->input->post('form_alamat');
		$status 		= $this->input->post('form_status');
		$table 			= 'pelanggan';

		$data 		= array('id_pelanggan' => $id_pelanggan, 'NIK' => $nik, 'nama_pelanggan' => $nm_pelanggan, 'jenis_kelamin' => $jk, 'alamat' => $alamat, 'no_telpon' => $hp, 'status' => $status);

		$this->M_Query->insert_data($table,$data);

		redirect(base_url().'data/pelanggan');
	}

	function pelanggan_update_page()
	{
		$id 				= $this->uri->segment(4);
		$field 				= "*";
		$table 				= "pelanggan";
		$condition 			= array('id_pelanggan' => $id );
		$data['pelanggan'] 	= $this->M_Query->select_condition($field,$table,$condition)->result();

		$data['level']		= $this->session->userdata("level");
		$data['title']		= 'Data Pelanggan';		

		$this->template->display('pelanggan/V_Update',$data);	
	}

	function action_update()
	{
		$id_pelanggan 	= $this->input->post('form_id_pelanggan');
		$status 		= $this->input->post('form_status');
		$nik 			= $this->input->post('form_nik');
		$nm_pelanggan	= $this->input->post('form_nm_pelanggan');			
		$jk 			= $this->input->post('form_jk');
		$hp 	 		= $this->input->post('form_hp');
		$alamat			= $this->input->post('form_alamat');
		$table 			= 'pelanggan';

		$value 		= array('NIK' => $nik, 'nama_pelanggan' => $nm_pelanggan, 'jenis_kelamin' => $jk, 'alamat' => $alamat, 'no_telpon' => $hp, 'status' => $status);
		$condition 	= array('id_pelanggan' => $id_pelanggan);

		$this->M_Query->update_data($table,$value,$condition);

		redirect(base_url().'data/pelanggan');
	}

	function pelanggan_delete_action()
	{
		$id 			= $this->uri->segment(4);
		$table 			= "pelanggan";
		$condition 		= array('id_pelanggan' => $id );
		
		$this->M_Query->delete_data($condition,$table);

		redirect(base_url().'data/pelanggan');
	}
}