<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function index()
	{
	$data['konten']="v_kategori";
    $this->load->model('Kategori_model');
    $data['data_kategori']=$this->Kategori_model->get_kategori();
	$this->load->view('template', $data, FALSE);
	}
	public function simpan_kategori()
	{
		$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'trim|required',
		array('required' => 'nama kategori harus diisi'));
		if ($this->form_validation->run() == TRUE )
		{
			$this->load->model('kategori_model', 'kat');
			$masuk=$this->kat->masuk_db();
			if($masuk==true){
				$this->session->set_flashdata('pesan', 'sukses masuk');
			} else{
				$this->session->set_flashdata('pesan', 'gagal masuk');
			}
			redirect(base_url('index.php/kategori'), 'refresh');
		}
		else{
			$this->session->set_flashdata('pesan', validation_errors());
			redirect(base_url('index.php/kategori'), 'refresh');
		}
	}
	public function get_detail_kategori($id_kategori='')
	{
	$this->load->model('kategori_model');
	$data_detail=$this->kategori_model->detail_kategori($id_kategori);
	echo json_encode($data_detail);
	}
	public function update_kategori()
	{
		$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'trim|required',
		array('required' => 'nama kategori harus diisi'));
		if ($this->form_validation->run() == FALSE ){
			$this->session->set_flashdata('pesan', validation_errors());
			redirect(base_url('index.php/Kategori'), 'refresh');
		} else{
			$this->load->model('Kategori_model');
			$proses_update=$this->Kategori_model->update_kategori();
			if ($proses_update) {
				$this->session->set_flashdata('pesan', 'sukses update');
			}
			else {
				$this->session->set_flashdata('pesan', 'gagal update');
			}
			redirect(base_url('index.php/Kategori'), 'refresh');
		}
	}
    public function hapus_kategori($id_kategori)
    {
    $this->load->model('kategori_model');
	$this->kategori_model->hapus_kategori($id_kategori);
	redirect(base_url('index.php/Kategori'), 'refresh');
    }

}

/* End of file Kategori.php */
/* Location: ./application/controllers/Kategori.php */