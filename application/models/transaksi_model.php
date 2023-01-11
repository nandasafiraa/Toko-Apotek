
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

	public function cari_obat()
	{
		$data_cart = $this->db->where('obat.nama_obat', $this->input->post('nama_obat'))
							  ->join('kategori', 'kategori.id_kategori = obat.id_kategori')
							  ->get('obat')
							  ->row();
		if($data_cart != NULL){

			if($data_cart->stok > 0){
				$cart_array = array(
								'cart_id'	=> $this->session->userdata('username'),
								'id_obat' 	=> $data_cart->id_obat
							);						
				$this->db->insert('cart',$cart_array);

				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	public function get_data_obat_by_id($id)
	{
		return $this->db->where('id_obat', $id)
						->get('obat')
						->row();
	}

	public function get_cart()
	{
		return $this->db->where('cart.cart_id', $this->session->userdata('username'))
					    ->join('obat', 'obat.id_obat = cart.id_obat')
					    ->join('kategori', 'kategori.id_kategori = obat.id_kategori')
					    ->get('cart')
					    ->result();
	}

	public function hapus_item_cart()
	{
		$this->db->where('id', $this->input->post('hapus_id'))
				 ->delete('cart');

		if($this->db->affected_rows() > 0)
		{
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function ubah_jumlah_cart()
	{
		$data = array(
				'jumlah' => $this->input->post('jumlah')
			);

		
		$stok_awal = $this->get_data_obat_by_id($this->input->post('id_obat'))->stok;
		if($stok_awal >= $this->input->post('jumlah')){
			$this->db->where('id', $this->input->post('id'))
					 ->update('cart', $data);
			return TRUE;
		} else {
			return FALSE;
		}
	}
 
	public function get_total_belanja()
	{
		return $this->db->select('SUM(obat.harga*cart.jumlah) as total')
						->where('cart.cart_id', $this->session->userdata('username'))
						->join('obat', 'obat.id_obat = cart.id_obat')
						->get('cart')
						->row()->total;
	}

	public function tambah_transaksi()
	{
		$data_transaksi = array(
				'id_kasir'		=> $this->session->userdata('username'),
				'nama_pembeli'	=> $this->input->post('nama_pembeli')
			);
		$this->db->insert('transaksi', $data_transaksi);
		$last_insert_id = $this->db->insert_id();
	
		//memasukkan detil trans
		for($i = 0; $i < count($this->get_cart()); $i++)
		{
			$data_detil_transaksi = array(
				'id_transaksi'	=> $last_insert_id,
				'id_obat'		=> $this->input->post('id_obat')[$i],
				'jumlah'		=> $this->input->post('jumlah')[$i]
			);

			//masuk ke tbel detil
			$this->db->insert('detil_transaksi', $data_detil_transaksi);

			//ngurangin stok pas beli
			$stok_awal = $this->get_data_obat_by_id($this->input->post('id_obat')[$i])->stok;
			$stok_akhir = $stok_awal-$this->input->post('jumlah')[$i];
			$stok = array('stok' => $stok_akhir);
			$this->db->where('id_obat', $this->input->post('id_obat')[$i])
					 ->update('obat', $stok);

		}


		$this->db->where('cart_id', $this->session->userdata('username'))
				 ->delete('cart');

		return TRUE;

	}

	public function get_riwayat_transaksi()
	{
		return $this->db->select('transaksi.id_transaksi, transaksi.nama_pembeli, transaksi.id_kasir, transaksi.tanggal_beli, (SELECT SUM(detil_transaksi.jumlah*obat.harga) FROM detil_transaksi JOIN obat ON obat.id_obat = detil_transaksi.id_obat WHERE id_transaksi = transaksi.id_transaksi ) as total')
						->join('detil_transaksi','detil_transaksi.id_transaksi = transaksi.id_transaksi')
						->join('obat','obat.id_obat = detil_transaksi.id_obat')
						->group_by('id_transaksi')
						->get('transaksi')
						->result();
	}

	public function get_transaksi_by_id($id)
	{
		return $this->db->select('*')
						->where('id_transaksi', $id)
						->join('obat','obat.id_obat = detil_transaksi.id_obat')
						->join('kategori','kategori.id_kategori = obat.id_kategori')
						->get('detil_transaksi')
						->result();
	}	

}

/* End of file transaksi_model.php */
/* Location: ./application/models/transaksi_model.php */