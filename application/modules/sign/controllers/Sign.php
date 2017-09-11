<?php

class Sign extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('String_Generator');
		$this->load->model('query/M_Query');
	}

	function change_password()
	{
		$nip  		= $this->input->post('form_search');
		$condition 	= array('NIP' => $nip);

		if ($this->M_Query->select_condition('NIP','ASP_USER',$condition)->num_rows() == 1)
		{
			$data['nip'] = $this->M_Query->select_condition('*','ASP_USER',$condition)->result();
		}
		else
		{
			$data['nip'] = '';
		}

		$this->load->view('sign/V_Change_Pass',$data);
		
	}

	function do_change_password()
	{
		$key 				= "ITApplicationSupportGroupBankMandiriTbkPersero";

		$table 		= 'ASP_USER';
		$nip		= $this->input->post('form_change_nip');
		$password 	= $this->string_generator->ANCrypt($key,$this->input->post('form_change_password'));

		$value 		= array('PASSWORD' => $password);
		$condition 	= array('NIP' => $nip);

		$this->M_Query->update_data($table,$value,$condition);

		$this->session->set_flashdata('text','text["password_change"]');
		$this->session->set_flashdata('type','success');

		redirect(base_url());
	}

	function select_team()
	{
		$condition 	= array('DEPARTMENT_CODE'=>$this->input->post('department_code'));

		foreach ($this->M_Query->select_condition('*','ASP_TEAM',$condition)->result() as $field) 
		{
			$team[$field->TEAM_CODE] 	= $field->TEAM_DESC; 
		}

		print form_dropdown('team',$team);
	}

	function signin_page()
	{
		$this->load->view('sign/V_Signin');		
	}

	function signin_page_form()
	{
		$this->load->view('sign/V_Form');		
	}

	function signup_page()
	{	
		$data['department']		= $this->M_Query->select_all_data('ASP_DEPARTMENT')->result();
		$this->load->view('sign/V_Signup',$data);	
	}

	function signin_action()
	{
		$username 		= $this->input->post('form_signin_username');
		$password		= md5($this->input->post('form_signin_password'));

		$field			= array('*');
		$table			= "user";
		$condition 		= array('username'=>$username,'PASSWORD'=>$password);
		$condition_2	= array('username'=>$username);

		$select_user		=  $this->M_Query->select_condition($field,$table,$condition);

		foreach ($select_user->result() as $field_user) 
		{
			$username_user	= $field_user->username;
			$full_name 		= $field_user->nm_user;
			$level_user 	= $field_user->level;
		}

		if ($this->sign_validation->username_availablity($username_user) == 0)
		{
			$this->session->set_flashdata('text','text["wrong_userpass"]');
			$this->session->set_flashdata('type','error');

			redirect(base_url());
		}
		else
		{
			if ($select_user->num_rows() == 0)
			{
				$query_select	= $this->M_Query->select_condition($field,$table,$condition_2);

				$this->session->set_flashdata('text','text["wrong_userpass"]');
				$this->session->set_flashdata('type','error');

				redirect(base_url());	
			}
			else if ($select_user->num_rows() > 0)
			{
				$data_session	= array('username'=>$username_user,'full_name'=>$full_name,'level'=>$level_user);
				$this->session->set_userdata($data_session);

				redirect(base_url().'dashboard');;

			}
		}		
	}

	function signup_action()
	{
		$key 				= "ITApplicationSupportGroupBankMandiriTbkPersero";
		$table_user			= "ASP_USER";
		$table_employe		= "ASP_EMPLOYE";

		$nip				= $this->input->post('form_signup_nip');
		$full_name			= ucwords($this->input->post('form_signup_name'));
		$department_code	= $this->input->post('form_signup_departmentcode');
		$email				= $this->input->post('form_signup_email');
		$password			= $this->string_generator->ANCrypt($key,$this->input->post('form_signup_password'));
		$user_level 		= "NONE";
		$activation_status	= "ENABLE";
		$signed 			= "N";
		$wrong_password		= 0;
		$team				= $this->input->post('form_signup_teamcode');

		$value_user			= array('NIP'=>$nip,'FULL_NAME'=>$full_name,'DEPARTMENT_CODE'=>$department_code,'EMAIL'=>$email,'PASSWORD'=>$password,'USER_LEVEL'=>$user_level,'ACTIVATION_STATUS'=>$activation_status,'WRONG_PASSWORD'=>$wrong_password);

		$value_employe		= array('NIP'=>$nip,'FULL_NAME'=>$full_name,'EMAIL'=>$email,'DEPARTMENT_CODE'=>$department_code,'TEAM_CODE'=>$team,'EMPLOYE_STATUS'=>'Y');

		if ($this->sign_validation->nip_availablity($nip) > 0)
		{
			$this->session->set_flashdata('text','text["nip_registered"]');
			$this->session->set_flashdata('type','warning');

			redirect(base_url());
		}
		else
		{
			$this->M_Query->insert_data($table_user,$value_user);
			$this->M_Query->insert_data($table_employe,$value_employe);

			$this->session->set_flashdata('text','text["success_signup"]');
			$this->session->set_flashdata('type','success');

			redirect(base_url());
		}
	}

	function signout()
	{
		$this->session->sess_destroy();

		redirect(base_url());
	}

	function signout_all()
	{
		$nip  		= $this->input->post('form_search');
		$condition 	= array('NIP' => $nip);

		if ($this->M_Query->select_condition('NIP','ASP_USER',$condition)->num_rows() == 1)
		{
			$data['nip'] = $this->M_Query->select_condition('*','ASP_USER',$condition)->result();
		}
		else
		{
			$data['nip'] = '';
		}

		$this->load->view('sign/V_Signout',$data);
	}

	function do_signout_all()
	{
		$table 		= 'ASP_USER';
		$nip		= $this->input->post('form_change_nip');

		$value 		= array('SIGNED' => 'N', 'IP_ADDRESS' => NULL);
		$condition 	= array('NIP' => $nip);

		$this->M_Query->update_data($table,$value,$condition);

		$this->session->set_flashdata('text','text["signout_all"]');
		$this->session->set_flashdata('type','success');

		redirect(base_url());
	}
}

/* --- END OF FILE --- */
/* --- ©2017 Afdhal Afrilliyansyah --- */