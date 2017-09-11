<?php

class Home extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		if($this->sign_validation->signin_valid())
		{
			redirect(base_url());
		}
		
	}

	function dashboard_page()
	{
		$data['level']		= $this->session->userdata("level");
		$data['title']		= 'Dashboard';

		$this->template->display('home/V_Home',$data);	
	}
}
