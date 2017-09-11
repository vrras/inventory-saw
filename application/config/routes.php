<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/


//$url 		= explode("/",$_SERVER["REQUEST_URI"]);
//$base_url_asp = strtolower($url[1]);

$route['default_controller'] = 'sign/signin_page';
$route['404_override'] = 'not_found';
$route['translate_uri_dashes'] = FALSE;
$route['assets/(:any)'] = 'assets/$1';

//$route['bye'] = 'sign/signout';

// --- Sign ---
$route['form_login'] 		= 'sign/signin_page_form';
$route['login'] 			= 'sign/signin_action';
$route['logout']			= 'sign/signout';
$route['account']			= 'account/account_page';
$route['account/new']		= 'account/account_insert_page';
$route['account/donew']	= 'account/account_insert_do';
$route['account/edit/:any']	= 'account/account_update';
$route['account/doedit']	= 'account/account_update_do';
$route['account/delete/:any']	= 'account/account_delete';
$route['account/newpassword/:any']	= 'account/account_password';
$route['account/donewpassword']	= 'account/account_password_do';

// --- Dashboard ---
$route['dashboard'] 		= 'home/dashboard_page';

// --- Data Barang ---
$route['data/barang'] 				= 'barang/item_page';
$route['data/barang/input'] 		= 'barang/item_input_page';
$route['data/barang/input/action'] 	= 'barang/item_input_action';
$route['data/barang/action'] 		= 'barang/action_update';
$route['data/barang/edit/:any'] 	= 'barang/item_update_page';
$route['data/barang/edit/action'] 	= 'barang/item_update_action';
$route['data/barang/delete/:any'] 	= 'barang/item_delete_action';

// --- Data Pelanggan ---
$route['data/pelanggan'] 				= 'pelanggan/pelanggan_page';
$route['data/pelanggan/input'] 			= 'pelanggan/pelanggan_input_page';
$route['data/pelanggan/actionipt'] 		= 'pelanggan/pelanggan_input_action';
$route['data/pelanggan/edit/:any'] 		= 'pelanggan/pelanggan_update_page';
$route['data/pelanggan/action'] 		= 'pelanggan/action_update';
$route['data/pelanggan/delete/:any'] 	= 'pelanggan/pelanggan_delete_action';

// --- Data Transaksi ---
$route['trx/penjualan'] 				= 'trx/transaksi_page';
$route['trx/penjualan/pelanggan'] 		= 'trx/transaksi_page_pelanggan';
$route['trx/penjualan/keranjang'] 		= 'trx/transaksi_input_keranjang';
$route['trx/penjualan/batal/:any'] 		= 'trx/transaksi_batal_keranjang';
$route['trx/penjualan/batalall'] 		= 'trx/transaksi_batalall_keranjang';
$route['trx/penjualan/simpan'] 			= 'trx/transaksi_simpan_penjualan';
$route['trx/penjualan/all'] 			= 'trx/transaksi_page_all';
$route['trx/penjualan/detail/:any'] 	= 'trx/transaksi_page_detail';
$route['trx/penjualan/delete/:any'] 	= 'trx/transaksi_delete_action';
$route['trx/penjualan/cetak/:any'] 		= 'trx/transaksi_cetak';

// --- Data Penilaian ---
$route['penilaian/kriteria'] 			= 'penilaian/kriteria_page';
$route['penilaian/kriteria/edit/:any'] 	= 'penilaian/kriteria_update_page';
$route['penilaian/kriteria/action'] 	= 'penilaian/kriteria_update_action';

$route['penilaian/subkriteria/:any'] 		= 'penilaian/subkriteria_page';
$route['penilaian/subkriteria/tambah/:any']	= 'penilaian/subkriteria_page_tambah';
$route['penilaian/subkriteria/action/:any'] = 'penilaian/subkriteria_action_tambah';
$route['penilaian/subkriteria/update/:any'] = 'penilaian/subkriteria_update';
$route['penilaian/subkriteria/delete/:any/:any'] = 'penilaian/subkriteria_delete';
$route['penilaian/subkriteria/edit/:any'] 	 	 = 'penilaian/subkriteria_edit';
$route['penilaian/aksi/subkriteria'] 	 		 = 'penilaian/subkriteria_do_edit';

//$route['penilaian/normalisasi/periode1'] 	 	= 'penilaian/normalisasip1_page';
//$route['penilaian/normalisasi/periode2'] 	 	= 'penilaian/normalisasip2_page';
$route['penilaian/normalisasi'] 	 	= 'penilaian/normalisasi_page';
$route['penilaian/rangking'] 	 		= 'penilaian/rangking_page';


// --- Data Alternatif ---
$route['penilaian/alternatif'] 			= 'penilaian/alternatif_page';

// === Laporan Penjualan ===
$route['laporan/penjualan/yearly'] 		= 'laporan/laporan_penjualan_yearly';
$route['laporan/penjualan/monthly'] 	= 'laporan/laporan_penjualan_monthly';
$route['laporan/penjualan/daily'] 		= 'laporan/laporan_penjualan_daily';
$route['print/penjualan/yearly/:any'] 	= 'laporan/print_penjualan_yearly';
$route['print/penjualan/monthly/:any'] 	= 'laporan/print_penjualan_monthly';
$route['print/penjualan/daily/:any'] 	= 'laporan/print_penjualan_daily';

// === Laporan barang ===
$route['laporan/barang/yearly'] 		= 'laporan/laporan_barang_yearly';
$route['laporan/barang/monthly'] 		= 'laporan/laporan_barang_monthly';
$route['laporan/barang/daily'] 			= 'laporan/laporan_barang_daily';
$route['print/barang/yearly/:any'] 		= 'laporan/print_barang_yearly';
$route['print/barang/monthly/:any'] 	= 'laporan/print_barang_monthly';
$route['print/barang/daily/:any'] 		= 'laporan/print_barang_daily';

// === Laporan pelanggan
$route['laporan/pelanggan'] 			= 'laporan/laporan_pelanggan';
$route['laporan/pelanggan/normalisasi'] = 'laporan/normalisasi_page';
$route['laporan/pelanggan/rangking'] 	= 'laporan/rangking_page';

// === Data hadiah ===
$route['data/hadiah'] 				= 'hadiah/hadiah_page';
$route['data/hadiah/input'] 		= 'hadiah/hadiah_input_page';
$route['data/hadiah/input/action'] 	= 'hadiah/hadiah_input_action';
$route['data/hadiah/action'] 		= 'hadiah/action_update';
$route['data/hadiah/edit/:any'] 	= 'hadiah/hadiah_update_page';
$route['data/hadiah/edit/action'] 	= 'hadiah/hadiah_update_action';
$route['data/hadiah/delete/:any'] 	= 'hadiah/hadiah_delete_action';
