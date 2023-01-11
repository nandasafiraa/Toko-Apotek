<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function get_user()
	{
		$data_user= $this->db->get('User')->result();
		return $data_user;
	}
	public function masuk_db()
  	{
    $data_user=array(
      'nama_user'=>$this->input->post('nama_user'),
      'username'=>$this->input->post('username'),
      'password'=>$this->input->post('password'),
      'level'=>$this->input->post('level')
    );
    $ql_masuk=$this->db->insert('User', $data_user);
    return $ql_masuk;
  	}
  	public function detail_user($id_user='')
  {
  return $this->db->where('id_user', $id_user)->get('User')->row();
  }
  public function update_user()
  {
    $dt_up_user=array(
      'nama_user' =>$this->input->post('nama_user'),
      'username' =>$this->input->post('username'),
      'password' =>$this->input->post('password'),
      'level' =>$this->input->post('level')
    );
  return $this->db->where('id_user',$this->input->post('id_user'))->update('User', $dt_up_user);
  }
  public function hapus_user($id_user)
  {
    $this->db->where('id_user', $id_user);
     return $this->db->delete('User');
  }

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */