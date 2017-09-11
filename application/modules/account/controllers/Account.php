<?php

class Account extends CI_Controller
{
	function __construct()
	{
		parent:: __construct();
		$this->load->model('query/M_Query');
		if($this->sign_validation->signin_valid())
		{
			redirect(base_url());
		}
	}	

	function account_page()
	{
		$data['page'] 	= 'utama';
		$data['account'] 	= $this->M_Query->select_all_data('user')->result();

		$data['level']		= $this->session->userdata("level");
		$data['title']		= 'User Account';

		$this->template->display('account/V_Account',$data);
	}

	function account_insert_page()
	{
		$data['page'] 	= 'insert';
		$data['level']	= $this->session->userdata("level");
		$data['title']	= 'New User Account';

		$this->template->display('account/V_Account',$data);
	}

	function account_insert_do()
	{
		$id 	 	= "";
		$nm_user 	= $this->input->post('form_nm_user');
		$username 	= $this->input->post('form_username');
		$password 	= $this->input->post('form_password');
		$level 		= $this->input->post('form_level');

		$data 		= array('id_user' => $id, 'nm_user' => $nm_user, 'username' => $username, 'password' => $password, 'level' => $level );

		if($this->M_Query->insert_data('user',$data))
		{
			redirect(base_url().'account');
		}
		else
		{
			echo "<script>alert('Tidak dapat menambahkan data');</script>";
			redirect(base_url().'account','refresh');
		}
	}

	function account_update()
	{
		$data['page'] 	= 'update';
		$id 	= $this->uri->segment(3);
		$condition = array('id_user' => $id );
		$data['account'] 	= $this->M_Query->select_condition('*','user',$condition)->result();

		$data['level']		= $this->session->userdata("level");
		$data['title']		= 'Edit User Account';

		$this->template->display('account/V_Account',$data);
	}

	function account_update_do()
	{
		$id 	 	= $this->input->post('form_id_user');
		$nm_user 	= $this->input->post('form_nm_user');
		$username 	= $this->input->post('form_username');

		$value 		= array('nm_user' => $nm_user, 'username' => $username );
		$condition  = array('id_user' => $id );

		if($this->M_Query->update_data('user',$value,$condition))
		{
			echo "<script>alert('Tidak dapat update data');</script>";
			redirect(base_url().'account','refresh');
		}
		else
		{
			redirect(base_url().'account');
		}
	}

	function account_password()
	{
		$data['page'] 	= 'password';
		$id 	= $this->uri->segment(3);
		$condition = array('id_user' => $id );
		$data['account'] 	= $this->M_Query->select_condition('*','user',$condition)->result();

		$data['level']		= $this->session->userdata("level");
		$data['title']		= 'Change Password User Account';

		$this->template->display('account/V_Account',$data);
	}

	function account_password_do()
	{
		$id 	 	= $this->input->post('form_id_user');
		$password 	= md5($this->input->post('form_password_baru'));

		$value 		= array('password' => $password );
		$condition  = array('id_user' => $id );

		if($this->M_Query->update_data('user',$value,$condition))
		{
			echo "<script>alert('Tidak dapat mengganti password');</script>";
			redirect(base_url().'account','refresh');
		}
		else
		{
			redirect(base_url().'account');
		}
	}

	function account_delete()
	{
		$id 	 = $this->uri->segment(3);
		$condition = array('id_user' => $id );

		if($this->M_Query->delete_data($condition,'user'))
		{
			echo "<script>alert('Tidak dapat menghapus data');</script>";
			redirect(base_url().'account','refresh');
		}
		else
		{
			redirect(base_url().'account');
		}
	}
}

?>