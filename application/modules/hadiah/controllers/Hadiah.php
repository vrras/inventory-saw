<?php

class Hadiah extends CI_Controller
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

	function hadiah_page()
	{
		$table 				= "hadiah";
		$data['hadiah'] 	= $this->M_Query->select_all_data($table)->result();

        $data['level']		= $this->session->userdata("level");
        $data['page']		= "hadiah_page";
		$data['title']		= 'Data hadiah';

		$this->template->display('hadiah/V_Hadiah',$data);
	}

	function hadiah_input_page()
	{
		$data['level']		= $this->session->userdata("level");
        $data['page']		= "hadiah_input_page";
		$data['title']		= 'Data hadiah';

		$this->template->display('hadiah/V_Hadiah',$data);
	}

	function hadiah_input_action()
	{
		$id_hadiah 	= "";
		$nm_hadiah	= $this->input->post('form_nm_hadiah');
		$table 		= 'hadiah';

		$data 		= array('id_hadiah' => $id_hadiah, 'nama_hadiah' => $nm_hadiah);

		$this->M_Query->insert_data($table,$data);

		redirect(base_url().'data/hadiah');
	}

	function hadiah_update_page()
	{
		$id 				= $this->uri->segment(4);
		$field 				= "*";
		$table 				= "hadiah";
		$condition 			= array('id_hadiah' => $id );
		$data['hadiah'] 	= $this->M_Query->select_condition($field,$table,$condition)->result();

		$data['level']		= $this->session->userdata("level");
        $data['page']		= "hadiah_update_page";
		$data['title']		= 'Data hadiah';

		$this->template->display('hadiah/V_Hadiah',$data);
	}

	function action_update()
	{
		$id_hadiah 	= $this->input->post('form_id_hadiah');
		$nm_hadiah	= $this->input->post('form_nm_hadiah');
		$table 		= 'hadiah';

		$value 		= array('nama_hadiah' => $nm_hadiah);
		$condition 	= array('id_hadiah' => $id_hadiah);

		$this->M_Query->update_data($table,$value,$condition);

		redirect(base_url().'data/hadiah');
	}

	function hadiah_delete_action()
	{
		$id 			= $this->uri->segment(4);
		$table 			= "hadiah";
		$condition 		= array('id_hadiah' => $id );

		$data['hadiah'] = $this->M_Query->delete_data($condition,$table);

		redirect(base_url().'data/hadiah');
	}
}