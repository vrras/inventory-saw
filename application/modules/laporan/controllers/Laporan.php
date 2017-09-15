<?php

class Laporan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('laporan/M_Laporan');
		$this->load->model('penilaian/M_Penilaian');
		$this->load->model('query/M_Query');

		if($this->sign_validation->signin_valid())
		{
			redirect(base_url());
		}

	}

	function laporan_penjualan_yearly()
	{
		$data['page'] 		= $this->uri->segment(3);
		$date 				= $this->input->post('form_year');
		if($date=='')
		{
			$year 			= date("Y");
			$data['year'] 	= date("Y");
		}else
		{
			$year 			= $date;
			$data['year'] 	= $date;
		}

		$data['trx'] 		= $this->M_Laporan->yearly_transaction($year)->result();

		$data['level']		= $this->session->userdata("level");
		$data['title']		= 'Laporan Penjualan';

		$this->template->display('laporan/V_Laporan_Penjualan',$data);
	}

	function print_penjualan_yearly()
	{
		$year 				= $this->uri->segment(4);
		$data['trx'] 		= $this->M_Laporan->yearly_transaction($year)->result();

		$data['page'] 		= 'print_year';
		$data['level']		= $this->session->userdata("level");
		$data['title']		= 'Laporan Penjualan Tahunan';

		$this->load->view('laporan/V_Print_Penjualan',$data);
	}

	function laporan_penjualan_monthly()
	{
		$data['page'] 	= $this->uri->segment(3);
		$month 	= $this->input->POST('form_month');
		$year 	= $this->input->POST('form_year');

		if((($month == "Month") AND ($year == "Year")) OR (($month == "") AND ($year == "")))
		{
			$month 	= date('Y-m');
			$data['month_title'] = date('F Y');

			$data['title']	= 'Laporan Penjualan';
			$data['bulantahun'] = $month;
			$data['trx_month']	= $this->M_Laporan->monthly_transaction($month)->result();

			$this->template->display('laporan/V_Laporan_Penjualan',$data);
		}
		else
		{
			$month 	= $this->input->POST('form_year').'-'.$this->input->POST('form_month');
			switch (substr($month,-2))
			{
				case 1 : $data['month_title'] = 'January '.$this->input->POST('form_year'); break;
				case 2 : $data['month_title'] = 'February '.$this->input->POST('form_year'); break;
				case 3 : $data['month_title'] = 'March '.$this->input->POST('form_year'); break;
				case 4 : $data['month_title'] = 'April '.$this->input->POST('form_year'); break;
				case 5 : $data['month_title'] = 'May '.$this->input->POST('form_year'); break;
				case 6 : $data['month_title'] = 'June '.$this->input->POST('form_year'); break;
				case 7 : $data['month_title'] = 'July '.$this->input->POST('form_year'); break;
				case 8 : $data['month_title'] = 'August '.$this->input->POST('form_year'); break;
				case 9 : $data['month_title'] = 'September '.$this->input->POST('form_year'); break;
				case 10 : $data['month_title'] = 'October '.$this->input->POST('form_year'); break;
				case 11 : $data['month_title'] = 'November '.$this->input->POST('form_year'); break;
				case 12 : $data['month_title'] = 'December '.$this->input->POST('form_year'); break;
			}

			$data['title']	= 'Laporan Penjualan';
			$data['bulantahun'] = $month;
			$data['trx_month']	= $this->M_Laporan->monthly_transaction($month)->result();

			$this->template->display('laporan/V_Laporan_Penjualan',$data);

		}

	}

	function print_penjualan_monthly()
	{
		$month 				= $this->uri->segment(4);
		$data['trx'] 		= $this->M_Laporan->monthly_transaction($month)->result();

		$data['page'] 		= 'print_month';
		$data['level']		= $this->session->userdata("level");
		$data['title']		= 'Laporan Penjualan Bulanan';

		$this->load->view('laporan/V_Print_Penjualan',$data);
	}

	function laporan_penjualan_daily()
	{
		$data['page'] 	= $this->uri->segment(3);
		$date 	= $this->input->POST('form_date');

		if($date == "")
		{
			$date 		= date('Y-m-d');
		}

		$data['title']		= 'Laporan Penjualan';
		$data['trx_day']	= $this->M_Laporan->daily_transaction($date)->result();
		$data['date']		= $date;

		$this->template->display('laporan/V_Laporan_Penjualan',$data);
	}

	function print_penjualan_daily()
	{
		$date 				= $this->uri->segment(4);
		$data['trx'] 		= $this->M_Laporan->daily_transaction($date)->result();

		$data['page'] 		= 'print_daily';
		$data['level']		= $this->session->userdata("level");
		$data['title']		= 'Laporan Penjualan Harian';

		$this->load->view('laporan/V_Print_Penjualan',$data);
	}

	function laporan_barang_yearly()
	{
		$data['page'] 		= $this->uri->segment(3);
		$date 				= $this->input->post('form_year');
		if($date=='')
		{
			$year 			= date("Y");
			$data['year'] 	= date("Y");
		}else
		{
			$year 			= $date;
			$data['year'] 	= $date;
		}

		$data['trx'] 		= $this->M_Laporan->yearly_barang($year)->result();

		$data['level']		= $this->session->userdata("level");
		$data['title']		= 'Laporan Barang';

		$this->template->display('laporan/V_Laporan_Barang',$data);
	}

	function print_barang_yearly()
	{
		$year 				= $this->uri->segment(4);
		$data['trx'] 		= $this->M_Laporan->yearly_barang($year)->result();

		$data['page'] 		= 'print_year';
		$data['level']		= $this->session->userdata("level");
		$data['title']		= 'Laporan Penjualan Tahunan';

		$this->load->view('laporan/V_Print_Barang',$data);
	}

	function laporan_barang_monthly()
	{
		$data['page'] 	= $this->uri->segment(3);
		$month 	= $this->input->POST('form_month');
		$year 	= $this->input->POST('form_year');

		if((($month == "Month") AND ($year == "Year")) OR (($month == "") AND ($year == "")))
		{
			$month 	= date('Y-m');
			$data['month_title'] = date('F Y');

			$data['title']	= 'Laporan Barang';
			$data['bulantahun'] = $month;
			$data['trx_stok']	= $this->M_Laporan->monthly_stok_barang($month)->result();
			$data['trx_month']	= $this->M_Laporan->monthly_barang($month)->result();

			$this->template->display('laporan/V_Laporan_Barang',$data);
		}
		else
		{
			$month 	= $this->input->POST('form_year').'-'.$this->input->POST('form_month');
			switch (substr($month,-2))
			{
				case 1 : $data['month_title'] = 'January '.$this->input->POST('form_year'); break;
				case 2 : $data['month_title'] = 'February '.$this->input->POST('form_year'); break;
				case 3 : $data['month_title'] = 'March '.$this->input->POST('form_year'); break;
				case 4 : $data['month_title'] = 'April '.$this->input->POST('form_year'); break;
				case 5 : $data['month_title'] = 'May '.$this->input->POST('form_year'); break;
				case 6 : $data['month_title'] = 'June '.$this->input->POST('form_year'); break;
				case 7 : $data['month_title'] = 'July '.$this->input->POST('form_year'); break;
				case 8 : $data['month_title'] = 'August '.$this->input->POST('form_year'); break;
				case 9 : $data['month_title'] = 'September '.$this->input->POST('form_year'); break;
				case 10 : $data['month_title'] = 'October '.$this->input->POST('form_year'); break;
				case 11 : $data['month_title'] = 'November '.$this->input->POST('form_year'); break;
				case 12 : $data['month_title'] = 'December '.$this->input->POST('form_year'); break;
			}

			$data['title']	= 'Laporan Barang';
			$data['bulantahun'] = $month;
			$data['trx_stok']	= $this->M_Laporan->monthly_stok_barang($month)->result();
			$data['trx_month']	= $this->M_Laporan->monthly_barang($month)->result();

			$this->template->display('laporan/V_Laporan_Barang',$data);

		}

	}

	function print_barang_monthly()
	{
		$month 				= $this->uri->segment(4);
		$data['trx_stok']	= $this->M_Laporan->monthly_stok_barang($month)->result();
		$data['trx_month']	= $this->M_Laporan->monthly_barang($month)->result();

		$data['page'] 		= 'print_month';
		$data['level']		= $this->session->userdata("level");
		$data['title']		= 'Laporan Barang Bulanan';

		$this->load->view('laporan/V_Print_Barang',$data);
	}

	function laporan_barang_daily()
	{
		$data['page'] 	= $this->uri->segment(3);
		$date 	= $this->input->POST('form_date');

		if($date == "")
		{
			$date 		= date('Y-m-d');
		}

		$data['title']		= 'Laporan Barang';
		$data['trx_stok']	= $this->M_Laporan->daily_stok_barang($date)->result();
		$data['trx_day']	= $this->M_Laporan->daily_barang($date)->result();
		$data['date']		= $date;

		$this->template->display('laporan/V_Laporan_Barang',$data);
	}

	function print_barang_daily()
	{
		$date 				= $this->uri->segment(4);
		$data['trx_stok']	= $this->M_Laporan->daily_stok_barang($date)->result();
		$data['trx_day']	= $this->M_Laporan->daily_barang($date)->result();

		$data['page'] 		= 'print_daily';
		$data['level']		= $this->session->userdata("level");
		$data['title']		= 'Laporan Penjualan Harian';

		$this->load->view('laporan/V_Print_Barang',$data);
	}

	function laporan_pelanggan()
	{
		$adagak 	= $this->M_Query->select_all_data('alternatif')->num_rows();
		if($adagak>0)
		{
			$this->M_Penilaian->delete_alternatif('alternatif');
		}

		$monthawal 	= $this->input->POST('form_month_awal');
		$yearawal 	= $this->input->POST('form_year_awal');
		$monthakhir = $this->input->POST('form_month_akhir');
		$yearakhir 	= $this->input->POST('form_year_akhir');

		if((($monthawal == "Month") OR ($yearawal == "Year")) OR (($monthawal == "") OR ($yearawal == "")) OR (($monthakhir == "Month") OR ($yearakhir == "Year")) OR (($monthakhir == "") OR ($yearakhir == "")))
		{
			$data['page'] 	= 'awal';
			$monthakhir 	= date('Y-m');
			$monthpotong 	= date("Y-m-d", mktime(0,0,0, date('m')-5,date('d'),date('Y')));
			$monthawal 		= substr($monthpotong, 0,7);
			$data['month_title'] = substr($monthawal, 0,7) .' - '. date('Y-m');

			$trx_akhir 	= $this->M_Penilaian->transaksi_akhir()->result();
			$data['criteria1'] 	= $this->M_Penilaian->criteria_one($monthawal,$monthakhir)->result();
			$data['totbel_sub']		= $this->M_Penilaian->get_subkriteria('1')->result();
			$data['stats_sub']		= $this->M_Penilaian->get_subkriteria('2')->result();
			$data['loyal_sub']		= $this->M_Penilaian->get_subkriteria('3')->result();

			$data['bulanawal'] 		= $monthawal;
			$data['bulanakhir'] 	= $monthakhir;
			$data['level']			= $this->session->userdata("level");
			$data['title']			= 'Data Alternatif';

			$this->template->display('laporan/V_Laporan_Pelanggan',$data);
		}
		else
		{
			if(($monthakhir>=$monthawal) AND ($yearakhir>=$yearawal))
			{
				$monthawal 	= $this->input->POST('form_year_awal').'-'.$this->input->POST('form_month_awal');
				$monthakhir	= $this->input->POST('form_year_akhir').'-'.$this->input->POST('form_month_akhir');

				$data['page'] 			= 'awal';
				$trx_akhir 				= $this->M_Penilaian->transaksi_akhir()->result();
				$data['criteria1'] 		= $this->M_Penilaian->criteria_one($monthawal,$monthakhir)->result();
				$data['totbel_sub']		= $this->M_Penilaian->get_subkriteria('1')->result();
				$data['stats_sub']		= $this->M_Penilaian->get_subkriteria('2')->result();
				$data['loyal_sub']		= $this->M_Penilaian->get_subkriteria('3')->result();
				$data['month_title'] 	= $monthawal .' - '. $monthakhir;

				$data['bulanawal'] 		= $monthawal;
				$data['bulanakhir'] 	= $monthakhir;

				$data['level']		= $this->session->userdata("level");
				$data['title']		= 'Data Alternatif';

				$this->template->display('laporan/V_Laporan_Pelanggan',$data);
			}
			else
			{
				redirect(base_url().'laporan/pelanggan');
			}
		}
	}

	function normalisasi_page()
	{
		$id_alternatif 		= $this->input->post('form_id_alternatif');
		$nama_alternatif	= $this->input->post('form_nama_alternatif');
		$criteria1  		= $this->input->post('form_criteria1');
		$criteria2  		= $this->input->post('form_criteria2');
		$criteria3	  		= $this->input->post('form_criteria3');

		$field 			= "*";
		$table 			= 'alternatif';
		$count 			= count($id_alternatif);

		for ($i=0; $i < $count; $i++) {

			$condition 		= array('id_alternatif' => $id_alternatif[$i] );
			$ada 	 		= $this->M_Query->select_condition($field,$table,$condition)->num_rows();
			if($ada==0)
			{
				$data = array('id_alternatif' => $id_alternatif[$i], 'nama_alternatif' => $nama_alternatif[$i] , 'criteria1' => $criteria1[$i], 'criteria2' => $criteria2[$i], 'criteria3' => $criteria3[$i]);
				$this->M_Query->insert_data($table,$data);
			}
			else
			{
				$value 				= array('nama_alternatif' => $nama_alternatif[$i] , 'criteria1' => $criteria1[$i], 'criteria2' => $criteria2[$i], 'criteria3' => $criteria3[$i]);
				$condition1 			= array('id_alternatif' => $id_alternatif[$i]);

				$this->M_Query->update_data($table,$value,$condition1);
			}

		}

		$last_month  	= $this->input->post('form_last_month');
		$today	  		= $this->input->post('form_today');

		$data['month_title'] 	= $last_month .' - '. $today;

		$data['bulanawal'] 	= $last_month;
		$data['bulanakhir'] = $today;

		$data['criteria1'] 		= $this->M_Penilaian->criteria_one($last_month,$today)->result();

		$data['row_alternatif']	= $this->M_Query->select_all_data($table)->result();
		$data['benefitcost'] 	= $this->M_Penilaian->get_benefitcost()->result();
		$data['kriteria']		= $this->M_Query->select_all_data('kriteria')->result();
		$data['totbel_sub']		= $this->M_Penilaian->get_subkriteria('1')->result();
		$data['stats_sub']		= $this->M_Penilaian->get_subkriteria('2')->result();
		$data['loyal_sub']		= $this->M_Penilaian->get_subkriteria('3')->result();

		$data['page'] 			= 'tengah';
		$data['level']			= $this->session->userdata("level");
		$data['title']			= 'Normalisasi';

		$this->template->display('laporan/V_Laporan_Pelanggan',$data);
	}

	function rangking_page()
	{
		$data['page'] = 'akhir';
		$id_alternatif 		= $this->input->post('form_id_alternatif');
		$nilai 		 		= $this->input->post('form_nilai');
		$kunjungan	 		= $this->input->post('form_kunjungan');
		$belanja	 		= $this->input->post('form_total_blanja');
		$tahunawal			= substr($this->input->post('periode_terbaik'), 0,4);
		$bulanawal			= substr($this->input->post('periode_terbaik'), 5,2);
		$tahunakhir			= substr($this->input->post('periode_terbaik'), 10,4);
		$bulanakhir			= substr($this->input->post('periode_terbaik'), 15,2);
		$data['month_titlea']= $this->input->post('periode_terbaik');

		switch ($bulanawal)
		{
			case 1 : $per_awal = 'January '.$tahunawal; break;
			case 2 : $per_awal = 'February '.$tahunawal; break;
			case 3 : $per_awal = 'March '.$tahunawal; break;
			case 4 : $per_awal = 'April '.$tahunawal; break;
			case 5 : $per_awal = 'May '.$tahunawal; break;
			case 6 : $per_awal = 'June '.$tahunawal; break;
			case 7 : $per_awal = 'July '.$tahunawal; break;
			case 8 : $per_awal = 'August '.$tahunawal; break;
			case 9 : $per_awal = 'September '.$tahunawal; break;
			case 10 : $per_awal = 'October '.$tahunawal; break;
			case 11 : $per_awal = 'November '.$tahunawal; break;
			case 12 : $per_awal = 'December '.$tahunawal; break;
		}

		switch ($bulanakhir)
		{
			case 1 : $per_akhir = 'January '.$tahunakhir; break;
			case 2 : $per_akhir = 'February '.$tahunakhir; break;
			case 3 : $per_akhir = 'March '.$tahunakhir; break;
			case 4 : $per_akhir = 'April '.$tahunakhir; break;
			case 5 : $per_akhir = 'May '.$tahunakhir; break;
			case 6 : $per_akhir = 'June '.$tahunakhir; break;
			case 7 : $per_akhir = 'July '.$tahunakhir; break;
			case 8 : $per_akhir = 'August '.$tahunakhir; break;
			case 9 : $per_akhir = 'September '.$tahunakhir; break;
			case 10 : $per_akhir = 'October '.$tahunakhir; break;
			case 11 : $per_akhir = 'November '.$tahunakhir; break;
			case 12 : $per_akhir = 'December '.$tahunakhir; break;
		}

		$data['month_title']= $per_awal.' sampai '.$per_akhir;

		$table 			= 'alternatif';
		$count 			= count($id_alternatif);

		for ($i=0; $i < $count; $i++)
		{
			$value 			= array('hasil_alternatif' => $nilai[$i], 'jum_kunjungan' => $kunjungan[$i], 'avg_belanja' => $belanja[$i]);
			$condition 	 	= array('id_alternatif' => $id_alternatif[$i]);

			$this->M_Query->update_data($table,$value,$condition);
		}

		$data['alter'] 			= $this->M_Penilaian->get_rangking()->result();
		$data['hadiah'] 		= $this->M_Penilaian->get_hadiah()->result();
		$data['hadiahalt']		= $this->M_Query->select_all_data('hadiah_alternatif')->result();
		$data['double'] 		= $this->M_Penilaian->count_redudansi()->result();
		$data['level']			= $this->session->userdata("level");
		$data['title']			= 'Perangkingan';

		$this->template->display('laporan/V_Laporan_Pelanggan',$data);
	}
}