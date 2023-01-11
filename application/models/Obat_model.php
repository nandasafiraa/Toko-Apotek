<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obat_model extends CI_Model {

  public function get_obat()
  {
  return $this->db->join('Kategori', 'Kategori.id_kategori=Obat.id_kategori')->get('Obat')->result();
  }
   public function masuk_db()
  {
    $config['upload_path'] = './asset/foto';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size']  = '10000';
    $config['max_width']  = '102400';
    $config['max_height']  = '76800';
    
    $this->load->library('upload', $config);
    
    if ( ! $this->upload->do_upload('foto')){
      $this->session->set_flashdata('pesan', $this->upload->display_errors());
      return false;
    }
    else{
    $arr['kode_obat'] = $this->input->post('kode_obat');
    $arr['nama_obat'] = $this->input->post('nama_obat');
    $arr['foto'] = $this->upload->data('file_name');
    $arr['stok'] = $this->input->post('stok');
    $arr['harga'] = $this->input->post('harga');
    $arr['id_kategori'] = $this->input->post('id_kategori');
    $ql_masuk=$this->db->insert('Obat', $arr);
    return $ql_masuk;
    }

  }
  public function detail_obat($id_obat='')
  {
  return $this->db->where('id_obat', $id_obat)->get('Obat')->row();
  }
  public function update_obat()
  {
    $nama_foto = $_FILES['foto']['name'];
    if ($nama_foto!="") {

      $config['upload_path'] = './asset/foto';
      $config['allowed_types'] = 'gif|jpg|png|jpeg';
      $config['max_size']  = '1000000';
      $config['max_width']  = '1024000';
      $config['max_height']  = '768000';
      
      $this->load->library('upload', $config);
      
      if ( ! $this->upload->do_upload('foto')){
        $this->session->set_flashdata('pesan', $this->upload->display_errors());
        //echo $this->upload->display_errors();
        return false;

      }
      else{

       $dt_up_obat=array(
       'kode_obat' => $this->input->post('kode_obat'),
    'nama_obat' => $this->input->post('nama_obat'),
    'foto' => $this->upload->data('file_name'),
    'stok' => $this->input->post('stok'),
    'tanggal_kaduluarsa'=> $this->input->post('tanggal_kaduluarsa'),
    'harga' => $this->input->post('harga'),
    'id_kategori' => $this->input->post('id_kategori')
    );
  return $this->db->where('id_obat',$this->input->post('id_obat'))->update('Obat', $dt_up_obat);
      }
    }else{
        $dt_up_obat=array(
       'kode_obat' => $this->input->post('kode_obat'),
    'nama_obat' => $this->input->post('nama_obat'),
    'stok' => $this->input->post('stok'),
    'tanggal_kaduluarsa'=> $this->input->post('tanggal_kaduluarsa'),
    'harga' => $this->input->post('harga'),
    'id_kategori' => $this->input->post('id_kategori')
    );
  return $this->db->where('id_obat',$this->input->post('id_obat'))->update('Obat', $dt_up_obat);
      }
    
  }
  public function hapus_obat($id_obat)
  {
    $this->db->where('id_obat', $id_obat);
     return $this->db->delete('Obat');
  }

}

/* End of file Obat_model.php */
/* Location: ./application/models/Obat_model.php */