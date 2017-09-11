<?php

class Template 
{
	protected $_ci;

	function __construct()
	{
		$this->_ci 	= &get_instance();
	}

	function display($template,$data=null)
	{
		$data['tag_head'] 			= $this->_ci->load->view('template/Tag_Head',$data,true);
		$data['sidebar_menu'] 		= $this->_ci->load->view('template/Side_Menu',$data,true);
		$data['top_navigation'] 	= $this->_ci->load->view('template/Top_Navigation',$data,true);		
		$data['content'] 			= $this->_ci->load->view($template,$data,true);		
		$data['javascript'] 		= $this->_ci->load->view('template/Javascript',$data,true);
		$data['js_disable'] 		= $this->_ci->load->view('template/Js_Disable',$data,true);

		$this->_ci->load->view('template/V_Template.php',$data);

	}
}

/* --- END OF FILE --- */
/* --- ©2017 Afdhal Afrilliyansyah --- */