<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function index()
	{
		$data['konten']="v_user";
		$this->load->model('user_model');
		$data['data_user']=$this->user_model->get_user();
		$this->load->view('template', $data, FALSE);
	}
	public function simpan_user()
	{
		$this->form_validation->set_rules('nama_user', 'nama user', 'trim|required',
		array('required' => 'Nama User harus diisi'));
		$this->form_validation->set_rules('username', 'username', 'trim|required',
		array('required' => 'Username harus diisi'));
		$this->form_validation->set_rules('password', 'password', 'trim|required',
		array('required' => 'Password harus diisi'));
		$this->form_validation->set_rules('level', 'level', 'trim|required',
		array('required' => 'Level harus diisi'));


		if ($this->form_validation->run() == TRUE )
		{
			$this->load->model('user_model', 'ser');
			$masuk=$this->ser->masuk_db();
			if($masuk==true){
				$this->session->set_flashdata('pesan', 'sukses masuk');
			} else{
				$this->session->set_flashdata('pesan', 'gagal masuk');
			}
			redirect(base_url('index.php/User'), 'refresh');
		}
		else{
			$this->session->set_flashdata('pesan', validation_errors());
			redirect(base_url('index.php/User'), 'refresh');
		}
	}
	public function get_detail_user($id_user='')
	{
			$this->load->model('user_model');
			$data_detail=$this->user_model->detail_user($id_user);
			echo json_encode($data_detail);
	}
	public function update_user()
	{
		$this->form_validation->set_rules('nama_user', 'nama user', 'trim|required');
		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
		$this->form_validation->set_rules('level', 'level', 'trim|required');
		if ($this->form_validation->run() == FALSE ){
			$this->session->set_flashdata('pesan', validation_errors());
			redirect(base_url('index.php/User'), 'refresh');
		} else{
			$this->load->model('user_model');
			$proses_update=$this->user_model->update_user();
			if ($proses_update) {
				$this->session->set_flashdata('pesan', 'sukses update');
			}
			else {
				$this->session->set_flashdata('pesan', 'gagal update');
			}
			redirect(base_url('index.php/User'), 'refresh');
		}
	}
	public function hapus_user($id_user)
	{
		$this->load->model('user_model');
		$this->user_model->hapus_user($id_user);
		redirect(base_url('index.php/User'), 'refresh');
	}

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */