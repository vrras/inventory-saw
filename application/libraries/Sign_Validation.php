<?php

class Sign_Validation
{
	protected $ci;

	function __construct()
	{
		$this->ci 	= &get_instance();
		$this->ci->load->model('query/M_Query');
	}

	function add_wrong($nip)
	{
		$table		= "ASP_USER";
		$condition 	= array('NIP'=>$nip);

		$select_wrong	= $this->ci->M_Query->select_condition('WRONG_PASSWORD',$table,$condition);

		foreach ($select_wrong->result() as $wrong_field) 
		{
			$wrong 	= $wrong_field->WRONG_PASSWORD;
		}

		$update_field	= array('WRONG_PASSWORD'=>$wrong+1);

		$this->ci->M_Query->update_data($table,$update_field,$condition);
	}

	function activation_status($nip)
	{
		$field		= array('ACTIVATION_STATUS');
		$table		= "ASP_USER";
		$condition 	= array('NIP'=>$nip);

		$exec_query	= $this->ci->M_Query->select_condition($field,$table,$condition);

		foreach ($exec_query->result() as $field_data) 
		{
			return $field_data->ACTIVATION_STATUS;
		}
	}

	function change_status($nip)
	{
		$table		= "ASP_USER";
		$condition 	= array('NIP'=>$nip);
		
		$select_wrong	= $this->ci->M_Query->select_condition('WRONG_PASSWORD',$table,$condition);

		foreach ($select_wrong->result() as $wrong_field) 
		{
			$wrong 	= $wrong_field->WRONG_PASSWORD;
		}

		if ($wrong >= 9999999999999999)
		{
			$condition 	= array('NIP'=>$nip,'WRONG_PASSWORD >='=>'3');
			$update_field	= array('ACTIVATION_STATUS'=>'DISABLE');

			$this->ci->M_Query->update_data($table,$update_field,$condition);
		}
	}

	function username_availablity($username)
	{
		$field		= array('username');
		$table		= "user";
		$condition 	= array('username'=>$username);

		return $this->ci->M_Query->select_condition($field,$table,$condition)->num_rows();
	}

	function signin_valid()
	{
		if(($this->ci->session->userdata('username') == "")&&($this->ci->session->userdata('full_name') == ""))
		{
			return true;
		}
	}

	function signin_update($nip)
	{
		date_default_timezone_set("Asia/Jakarta");
		$datetime	= date('Y-m-j H:i:s');
		$table		= "ASP_USER";
		$condition 	= array('NIP'=>$nip);
		$update_field	= array('LAST_SIGNIN'=>$datetime);

		$this->ci->M_Query->update_data($table,$update_field,$condition);
	}
	
	function zero_wrong($nip)
	{
		$table		= "ASP_USER";
		$condition 	= array('NIP'=>$nip);
		$update_field	= array('WRONG_PASSWORD'=>'0');

		$this->ci->M_Query->update_data($table,$update_field,$condition);
	}
}


/* --- END OF FILE --- */
/* --- ©2017 Firas Luthfi Dwiyansyah --- */