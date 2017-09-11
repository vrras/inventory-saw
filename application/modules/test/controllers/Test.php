<?php
class Test extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('query/M_Channel');
	}

	function test_grafik()
	{
		$today		= date('jmy');
		$yesterday 	= date("jmy", mktime(0,0,0, date("m"), date("j")-1, date("y")));
		$last_week	= date("jmy", mktime(0,0,0, date("m"), date("j")-7, date("y")));
		$last_month	= date("jmy", mktime(0,0,0, date("m")-1, date("j"), date("y")));

		$data['today']			= $this->M_Channel->transaction($today,'BDS')->result();
		$data['yesterday']		= $this->M_Channel->transaction($yesterday,'BDS')->result();
		$data['lastweek']		= $this->M_Channel->transaction($last_week,'BDS')->result();
		$data['lastmonth']		= $this->M_Channel->transaction($last_month,'BDS')->result();

		$data['threshold']		= $this->M_Channel->statisctic_threshold('BDS','F')->result();

		$data['title']		= 'Test Grafik';

		$this->template->display('test/V_Test_Grafik',$data);
	}

}