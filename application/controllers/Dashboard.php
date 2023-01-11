<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('Login')!=true) {
			redirect(base_url('index.php/Login'), 'refresh');
		}
		$this->load->model('dashboard_model');
	}
	public function index()
	{
			$data['konten'] = 'dashboard_view';
			$data['jml_obat'] = $this->dashboard_model->get_jml_obat();
			$data['jml_transaksi'] = $this->dashboard_model->get_jml_transaksi();
			$data['jml_user'] = $this->dashboard_model->get_jml_user();
			$this->load->view('template', $data);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */