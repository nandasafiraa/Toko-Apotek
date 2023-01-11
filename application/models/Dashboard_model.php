<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	public function get_jml_obat(){
		return $this->db->select('count(*) as jml_obat')
					    ->get('obat')
					    ->row();
	}

	public function get_jml_transaksi(){
		return $this->db->select('count(*) as jml_transaksi')
					    ->get('transaksi')
					    ->row();
	}

	public function get_jml_user(){
		return $this->db->select('count(*) as jml_user')
					    ->get('user')
					    ->row();
	}

}

/* End of file Dashboard_model.php */
/* Location: ./application/models/Dashboard_model.php */