<?php

class Penilaian extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('query/M_Query');
		$this->load->model('penilaian/M_Penilaian');

		if($this->sign_validation->signin_valid())
		{
			redirect(base_url());
		}

	}

	// --- KRITERIA ---

	function kriteria_page()
	{
		$table 				= "kriteria";
		$data['kriteria'] 	= $this->M_Query->select_all_data($table)->result();

		$data['level']		= $this->session->userdata("level");
		$data['title']		= 'Data Kriteria';

		$this->template->display('penilaian/V_Kriteria',$data);
	}

	function kriteria_update_page()
	{
		//$id_kriteria		= $this->uri->segment(4);
		//$condition 			= array('id_kriteria' => $id_kriteria );
		//$field 				= "*";
		$table 				= "kriteria";
		//$data['kriteria']	= $this->M_Query->select_condition($field,$table,$condition)->result();
		$data['kriteria']	= $this->M_Query->select_all_data($table)->result();

		$data['level']		= $this->session->userdata("level");
		$data['title']		= 'Data Kriteria';

		$this->template->display('penilaian/V_Kriteria_Update',$data);
	}

	function kriteria_update_action()
	{
		$id_kriteria 		= $this->input->post('form_id_kriteria');
		$nm_kriteria		= $this->input->post('form_nm_kriteria');
		$atribut 			= $this->input->post('form_atribut');
		$bobot	 			= $this->input->post('form_bobot');

		$bobot_tp 			= $bobot[0];
		$bobot_pembayaran	= $bobot[1];
		$bobot_lk			= $bobot[2];

		if(($bobot_tp+$bobot_pembayaran+$bobot_lk)>100 OR ($bobot_tp+$bobot_pembayaran+$bobot_lk)<100)
		{
			echo "<script>alert('Total bobot harus 100%');</script>";
			redirect(base_url().'penilaian/kriteria/edit/1','refresh');
		}else
		{
			$bobot[0] 			= number_format($bobot[0]/100,2);
			$bobot[1] 			= number_format($bobot[1]/100,2);
			$bobot[2] 			= number_format($bobot[2]/100,2);

			$table 				= 'kriteria';

			$count	= $this->M_Query->select_all_data($table)->num_rows();

			for ($i=0; $i < $count; $i++) {
				$value 				= array('nm_kriteria' => $nm_kriteria[$i], 'atribut' => $atribut[$i], 'bobot' => $bobot[$i]);
				$condition 			= array('id_kriteria' => $id_kriteria[$i] );

				$this->M_Query->update_data($table,$value,$condition);
			}
			redirect(base_url().'penilaian/kriteria');
		}
	}

	function transaksi_batalall_keranjang()
	{
		$table 		= 'keranjang';
		$condition 	= array('del' => '1' );

		$this->M_Query->delete_data($condition,$table);
		redirect(base_url().'trx/penjualan');
	}

	// --- SUBKRITERIA ---
	function subkriteria_page()
	{
		$data['page'] 		= $this->uri->segment(3);

		//--- Kriteria ---
		$table 				= "kriteria";
		$data['kriteria'] 	= $this->M_Query->select_all_data($table)->result();

		$data['level']		= $this->session->userdata("level");
		$data['title']		= 'Data Subkriteria';

		$this->template->display('penilaian/V_Subkriteria',$data);
	}

	function subkriteria_page_tambah()
	{
		$data['page']		= $this->uri->segment(3);
		$data['id_kriteria']= $this->uri->segment(4);

		$data['level']		= $this->session->userdata("level");
		$data['title']		= 'Data Subkriteria';

		$this->template->display('penilaian/V_Subkriteria',$data);
	}

	function subkriteria_action_tambah()
	{
		$id 			= $this->uri->segment(4);

		$list 			= $this->input->post('form_list');
		$keterangan 	= $this->input->post('form_keterangan');
		$nilai 			= $this->input->post('form_nilai');

		//--- Subkriteria ---
		$table 			= 'subkriteria';
		$data 			= array('id_subkriteria' => '', 'id_kriteria' => $id , 'list' => $list, 'keterangan' => $keterangan, 'nilai' => $nilai);

		$this->M_Query->insert_data($table,$data);

		redirect(base_url().'/penilaian/subkriteria/update/'.$id);
	}

	function subkriteria_update()
	{
		$data['page'] 			= $this->uri->segment(2);
		$id						= $this->uri->segment(4);

		//--- Subkriteria ---
		$field 					= "*";
		$table 					= "subkriteria";
		$condition 				= array('id_kriteria' => $id );

		$data['subkriteria'] 	= $this->M_Query->select_condition($field,$table,$condition)->result();

		$data['field_kriteria']	= $id;

		//--- Kriteria ---
		$table2 				= "kriteria";
		$condition2 			= array('id_kriteria' => $id );
		$query 					= $this->M_Query->select_condition($field,$table2,$condition2)->result();

		foreach ($query as $field_query) {
			$data['judul'] 		= $field_query->nm_kriteria;
		}

		$data['level']			= $this->session->userdata("level");
		$data['title']			= 'Data Subkriteria';

		$this->template->display('penilaian/V_Subkriteria',$data);
	}

	function subkriteria_delete()
	{
		$id 		 = $this->uri->segment(4);
		$id_kriteria = $this->uri->segment(5);

		$table 		= 'subkriteria';
		$condition 	= array('id_subkriteria' => $id );

		$this->M_Query->delete_data($condition,$table);
		redirect(base_url().'penilaian/subkriteria/update/'.$id_kriteria);
	}

	function subkriteria_edit()
	{
		$data['page']	= $this->uri->segment(3);
		$id 		 	= $this->uri->segment(4);

		$field 				 = "*";
		$table 				 = "subkriteria";
		$condition			 = array('id_subkriteria' => $id );
		$data['subkriteria'] = $this->M_Query->select_condition($field,$table,$condition)->result();

		$data['level']			= $this->session->userdata("level");
		$data['title']			= 'Data Subkriteria';

		$this->template->display('penilaian/V_Subkriteria',$data);
	}

	function subkriteria_do_edit()
	{
		$id 			= $this->input->post('form_id');
		$list 			= $this->input->post('form_list');
		$keterangan 	= $this->input->post('form_keterangan');
		$nilai 			= $this->input->post('form_nilai');

		//--- Subkriteria ---
		$table 			= 'subkriteria';
		$value 			= array('list' => $list, 'keterangan' => $keterangan, 'nilai' => $nilai);
		$condition 		= array('id_subkriteria' => $id);

		$this->M_Query->update_data($table,$value,$condition);

		//--- Kriteria ---
		$field 			= "*";
		$table2 		= "subkriteria";
		$condition2		= array('id_subkriteria' => $id );

		$subkriteria	= $this->M_Query->select_condition($field,$table2,$condition2)->result();
		foreach ($subkriteria as $field_subkriteria) {
			$id_page 	= $field_subkriteria->id_kriteria;
		}

		redirect(base_url().'penilaian/subkriteria/update/'.$id_page);
	}

	function alternatif_page()
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

			$this->template->display('penilaian/V_Alternatif',$data);
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

				$this->template->display('penilaian/V_Alternatif',$data);
			}
			else
			{
				redirect(base_url().'penilaian/alternatif');
			}
		}
		/*
		$adagak 	= $this->M_Query->select_all_data('alternatif')->num_rows();
		if($adagak>0)
		{
			$this->M_Penilaian->delete_alternatif('alternatif');
		}

		$year		= date('Y');
		$data['page'] = 'awal';
		//$last_month	= date("Y-m", mktime(0,0, date("Y"), date("m")-6));
		$kurang_today = date("Y-m-d", mktime(0,0,0, date('m')-5,date('d'),date('Y')));
		$last_month   = substr($kurang_today, 5,2);
		$ylast_month  = $year.'-'.$last_month;
		$kurang_to 	  = date("Y-m-d", mktime(0,0,0, date('m')-11,date('d'),date('Y')));
		$las_month 	  = substr($kurang_to, 5,2);
		$ylas_month   = $year.'-'.$las_month;


		$today		= date('Y-m');
		$kurang 	= date("Y-m-d", mktime(0,0,0, date('m'),date('d'),date('Y')-1));
		$yearyes	= substr($kurang, 0,4);
		$periodeawal= $year.'-01';
		$periode1	= $year.'-06';
		$periode2	= $year.'-12';
		$periode21	= $yearyes.'-12';
		$trx_akhir 	= $this->M_Penilaian->transaksi_akhir()->result();

		if($today>=$periode1)
		{
			if($today==$periode1)
			{
				// === Periode 1 ===
				$last_month  = $ylast_month;
				$today 		= $today;
				$data['last_monthc1'] = $ylast_month;
				$data['todayc1'] 	  = $today;

				$data['criteria1'] 	= $this->M_Penilaian->criteria_one($last_month,$today)->result();
				$data['periode']	= 'periode1';
			}
			elseif($today==$periode2)
			{
				// === Periode 1 ===
				$las_month 	= $ylas_month;
				$today_1	= $periode1;
				$data['last_monthc1'] 	= $las_month;
				$data['todayc1'] 		= $today_1;

				$data['criteria1'] 	= $this->M_Penilaian->criteria_one($las_month,$today_1)->result();

				// === Periode 2 ===
				$tahum 	= substr($periode1, 0,4);
				$bulam  = substr($periode1, 5,2);
				$last_month1 = $tahum.'-0'.($bulam+1);;
				$today1 	 = $today;
				$data['last_monthc2'] 	= $last_month1;
				$data['todayc2'] 	 	= $today1;

				$data['criteria2'] 	= $this->M_Penilaian->criteria_one($last_month1,$today1)->result();
				$data['periode']	= 'periode2';

			}
			elseif ( $today>=$periode1 ) {
				// === Periode 1 ===
				$last_month 		= $periodeawal;
				$today 				= $periode1;
				$data['last_monthc1'] = $last_month;
				$data['todayc1'] 		= $today;

				$data['criteria1'] 	= $this->M_Penilaian->criteria_one($last_month,$today)->result();

				// === Periode 2 ===
				$tahum 	= substr($periode1, 0,4);
				$bulam  = substr($periode1, 5,2);
				$last_month1 = $tahum.'-'.($bulam+1);
				$today1 	 = $tahum.'-'.($bulam+6);
				$data['last_monthc2'] = $last_month1;
				$data['todayc2'] 	 = $today1;

				$data['criteria2'] 	= $this->M_Penilaian->criteria_one($last_month1,$today1)->result();
				$data['periode']	= 'periode1';
			}
		}
		else
		{
			// === Periode 2 ===
			$tahum 	= substr($periode1, 0,4);
			$bulam  = substr($periode1, 5,2);
			$last_month1 = ($tahum-1).'-0'.($bulam+1);
			$today1 	 = ($tahum-1).'-'.($bulam+6);
			$data['last_monthc2'] = $last_month1;
			$data['todayc2'] 	 = $today1;

			$data['criteria2'] 	= $this->M_Penilaian->criteria_one($last_month1,$today1)->result();
			$data['periode']	= 'periode2kurang';
		}

		$data['totbel_sub']		= $this->M_Penilaian->get_subkriteria('1')->result();
		$data['stats_sub']		= $this->M_Penilaian->get_subkriteria('2')->result();
		$data['loyal_sub']		= $this->M_Penilaian->get_subkriteria('3')->result();

		$data['level']		= $this->session->userdata("level");
		$data['title']		= 'Data Alternatif';

		$this->template->display('penilaian/V_Alternatif',$data);
		*/
	}

	function normalisasip1_page()
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
		$data['last_month123']  	= $this->input->post('form_last_month');
		$data['today123']	  		= $this->input->post('form_today');

		$data['criteria1'] 		= $this->M_Penilaian->criteria_one($last_month,$today)->result();

		$data['row_alternatif']	= $this->M_Query->select_all_data($table)->result();
		$data['benefitcost'] 	= $this->M_Penilaian->get_benefitcost()->result();
		$data['kriteria']		= $this->M_Query->select_all_data('kriteria')->result();
		$data['totbel_sub']		= $this->M_Penilaian->get_subkriteria('1')->result();
		$data['stats_sub']		= $this->M_Penilaian->get_subkriteria('2')->result();
		$data['loyal_sub']		= $this->M_Penilaian->get_subkriteria('3')->result();

		$data['page'] = 'tengah';
		$data['level']			= $this->session->userdata("level");
		$data['title']			= 'Normalisasi';

		$this->template->display('penilaian/V_Alternatif',$data);
	}

	function normalisasip2_page()
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
				$condition1 		= array('id_alternatif' => $id_alternatif[$i]);

				$this->M_Query->update_data($table,$value,$condition1);
			}

		}

		$last_month  		= $this->input->post('form_last_month1');
		$today	  		= $this->input->post('form_today1');

		$data['criteria1'] 		= $this->M_Penilaian->criteria_one($last_month,$today)->result();

		$data['row_alternatif']	= $this->M_Query->select_all_data($table)->result();
		$data['benefitcost'] 	= $this->M_Penilaian->get_benefitcost()->result();
		$data['kriteria']		= $this->M_Query->select_all_data('kriteria')->result();
		$data['totbel_sub']		= $this->M_Penilaian->get_subkriteria('1')->result();
		$data['stats_sub']		= $this->M_Penilaian->get_subkriteria('2')->result();
		$data['loyal_sub']		= $this->M_Penilaian->get_subkriteria('3')->result();

		$data['page'] = 'tengah';
		$data['level']			= $this->session->userdata("level");
		$data['title']			= 'Normalisasi';

		$this->template->display('penilaian/V_Alternatif',$data);
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
				$condition1 		= array('id_alternatif' => $id_alternatif[$i]);

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
		$data['tombol'] 		= 'proses';
		$data['level']			= $this->session->userdata("level");
		$data['title']			= 'Normalisasi';

		$this->template->display('penilaian/V_Alternatif',$data);
	}

	function rangking_page()
	{
		$data['page'] = 'akhir';
		$id_alternatif 		= $this->input->post('form_id_alternatif');
		$nilai 		 		= $this->input->post('form_nilai');
		$kunjungan	 		= $this->input->post('form_kunjungan');
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
			$value 			= array('hasil_alternatif' => $nilai[$i], 'jum_kunjungan' => $kunjungan[$i]);
			$condition 	 	= array('id_alternatif' => $id_alternatif[$i]);

			$this->M_Query->update_data($table,$value,$condition);
		}

		$data['alter'] 			= $this->M_Penilaian->get_rangking()->result();
		$data['hadiah'] 		= $this->M_Penilaian->get_hadiah()->result();
		$data['double'] 		= $this->M_Penilaian->count_redudansi()->result();
		$data['level']			= $this->session->userdata("level");
		$data['title']			= 'Perangkingan';

		$this->template->display('penilaian/V_Alternatif',$data);
	}
}


//SELECT id_transaksi, id_pelanggan, SUM(total_harga) as total_belanja FROM `transaksi` WHERE id_pelanggan = '222291'

/* SELECT pelanggan.nama_pelanggan, kriteria.nm_kriteria, subkriteria.nilai FROM `alternatif` LEFT JOIN pelanggan ON pelanggan.id_pelanggan = alternatif.id_pelanggan LEFT JOIN kriteria ON kriteria.id_kriteria = alternatif.id_kriteria LEFT JOIN subkriteria ON subkriteria.id_subkriteria = alternatif.id_subkriteria ORDER BY pelanggan.id_pelanggan ASC */