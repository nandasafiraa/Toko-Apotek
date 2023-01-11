<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obat extends CI_Controller {

	public function index()
	{
		$data['konten']="v_obat";
		$this->load->model('Obat_model');
		$data['arr']=$this->Obat_model->get_obat();
		$this->load->model('kategori_model');
		$data['data_kategori']=$this->kategori_model->get_kategori();
		$this->load->view('template', $data, FALSE);
	}
	public function simpan_obat()
	{
		$this->form_validation->set_rules('kode_obat', 'kode obat', 'trim|required',
		array('required' => 'Kode Obat harus diisi'));
		$this->form_validation->set_rules('nama_obat', 'nama obat', 'trim|required',
		array('required' => 'Nama Obat harus diisi'));
		$this->form_validation->set_rules('tanggal_kaduluarsa', 'tanggal kaduluarsa', 'trim|required',
		array('required' => 'Tanggal Kaduluarsa harus diisi'));
		$this->form_validation->set_rules('stok', 'stok', 'trim|required',
		array('required' => 'Stok harus diisi'));
		$this->form_validation->set_rules('harga', 'harga', 'trim|required',
		array('required' => 'Harga harus diisi'));
		$this->form_validation->set_rules('id_kategori', 'id kategori', 'trim|required',
		array('required' => 'id kategori harus diisi'));


		if ($this->form_validation->run() == TRUE )
		{
			$this->load->model('Obat_model', 'bat');
			$masuk=$this->bat->masuk_db();
			if($masuk==true){
				$this->session->set_flashdata('pesan', 'sukses masuk');
			} else{
				$this->session->set_flashdata('pesan', 'gagal masuk');
			}
			redirect(base_url('index.php/Obat'), 'refresh');
		}
		else{
			$this->session->set_flashdata('pesan', validation_errors());
			redirect(base_url('index.php/Obat'), 'refresh');
		}
	}

	public function get_detail_obat($id_obat='')
	{
			$this->load->model('Obat_model');
			$data_detail=$this->Obat_model->detail_obat($id_obat);
			echo json_encode($data_detail);
	}

	public function update_obat()
	{
		$this->form_validation->set_rules('kode_obat', 'nama obat', 'trim|required');
		$this->form_validation->set_rules('nama_obat', 'nama obat', 'trim|required');
		$this->form_validation->set_rules('tanggal_kaduluarsa', 'tanggal kaduluarsa', 'trim|required');
		$this->form_validation->set_rules('stok', 'Stok', 'trim|required');		
		$this->form_validation->set_rules('harga', 'Harga', 'trim|required');
		$this->form_validation->set_rules('id_kategori', 'Id Kategori', 'trim|required');
		if ($this->form_validation->run() == FALSE ){
			$this->session->set_flashdata('pesan', validation_errors());
			redirect(base_url('index.php/Obat'), 'refresh');
		} else{
			$this->load->model('Obat_model');
			$proses_update=$this->Obat_model->update_obat();
			if ($proses_update) {
				$this->session->set_flashdata('pesan', 'sukses update');
			}
			else {
				$this->session->set_flashdata('pesan', 'gagal update');
			}
			redirect(base_url('index.php/Obat'), 'refresh');
		}
	}
	public function hapus_obat($id_obat)
	{
		$this->load->model('Obat_model');
		$this->Obat_model->hapus_obat($id_obat);
		redirect(base_url('index.php/Obat'), 'refresh');
	}

}

/* End of file Obat.php */
/* Location: ./application/controllers/Obat.php */