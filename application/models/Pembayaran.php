<?php

class Pembayaran extends CI_model{

	public function getAllPembayaranBank($id, $status = null, $bulan = null){
		if ($status === "pending"){
			return $this->db->get_where('pembayaran', ['id_bank' => $id, 'status' => 'pending'])->result_array();		
		}elseif ($status === "verified") {
			if($bulan != null){
				$this->db->where('id_bank', $id);
				$this->db->where('status', 'verified');
				$where = "date_part('month', tanggal_pembayaran) = ".$bulan;
				$this->db->where($where);				
				$this->db->from('pembayaran');
				return $this->db->count_all_results();
			}		
			else
				return $this->db->get_where('pembayaran', ['id_bank' => $id, 'status' => 'verified'])->result_array();			
		}
	}

	public function getPembayaranByBulan($bulan){
		$this->db->select('*');
		$this->db->from('pembayaran');
		$this->db->join('bank', "pembayaran.id_bank = bank.id_bank");
		$this->db->join('pelanggan', "pembayaran.id_pelanggan = pelanggan.id_pelanggan");
		$this->db->where(array('pembayaran.bulan_bayar' => $bulan, 'pembayaran.status' => 'verified'));	
		return $this->db->get()->result_array();			
	}

	public function getPembayaranByBulanBank($bulan, $idbank){
		$this->db->select('*');
		$this->db->from('pembayaran');
		$this->db->join('bank', "pembayaran.id_bank = bank.id_bank");
		$this->db->join('pelanggan', "pembayaran.id_pelanggan = pelanggan.id_pelanggan");
		$this->db->where(array('pembayaran.bulan_bayar' => $bulan, 'pembayaran.status' => 'verified', 'pembayaran.id_bank' => $idbank));	
		return $this->db->get()->result_array();			
	}	

	public function getPembayaranById($id, $tipe){
		switch ($tipe) {
			case 'pelanggan':
				$this->db->select('*');
				$this->db->from('pembayaran');
				$this->db->join('bank', "pembayaran.id_bank = bank.id_bank");
				$this->db->where(array('pembayaran.id_pelanggan' => $id));
				return $this->db->get()->result_array();
				break;			
			case 'pembayaran':
				$this->db->select('*');
				$this->db->from('pembayaran');
				$this->db->join('bank', "pembayaran.id_bank = bank.id_bank");
				$this->db->where(array('pembayaran.id_pembayaran' => $id));
				return $this->db->get()->result_array();
				break;		
			case 'tagihan':
				$this->db->select('*');
				$this->db->from('pembayaran');
				$this->db->join('bank', "pembayaran.id_bank = bank.id_bank");
				$this->db->where(array('pembayaran.id_tagihan' => $id));
				return $this->db->get()->result_array();
				break;		
			case 'detailPembayaran':
				$this->db->select('*');
				$this->db->from('pembayaran');
				$this->db->join('bank', "pembayaran.id_bank = bank.id_bank");
				$this->db->join('pelanggan', "pembayaran.id_pelanggan = pelanggan.id_pelanggan");
				$this->db->join('penggunaan', "penggunaan.id_pelanggan = pelanggan.id_pelanggan");
				$this->db->join('tarif', "pelanggan.id_tarif = tarif.id_tarif");
				$this->db->where(array('pembayaran.id_pembayaran' => $id));
				return $this->db->get()->result_array();
				break;								
			default:
				break;
		}
	}

	public function getAllPembayaranGroup(){
		$this->db->select('COUNT(*), bulan_bayar');
		$this->db->from('pembayaran');
		$this->db->group_by('bulan_bayar');
		$this->db->order_by('bulan_bayar', 'ASC');
		$this->db->where('status', 'verified');
		return $this->db->get()->result_array();
	}

	public function getAllPembayaranGroupBank($idbank){
		$this->db->select('COUNT(*), bulan_bayar');
		$this->db->from('pembayaran');
		$this->db->group_by('bulan_bayar');
		$this->db->order_by('bulan_bayar', 'ASC');
		$this->db->where('status', 'verified');
		$this->db->where('id_bank', $idbank);
		return $this->db->get()->result_array();
	}

	public function tolakPembayaran($id_pembayaran){
		$this->db->where('id_pembayaran', $id_pembayaran);
		$this->db->delete('pembayaran');
	}	

	public function verifiedPembayaran($id_pembayaran){
		$data = array(
			'status' => 'verified'
		);

		$this->db->where('id_pembayaran', $id_pembayaran);
		$this->db->update('pembayaran', $data);
	}

	public function getTagihanByPembayaran($id_pembayaran){
		$query = $this->db->get_where('pembayaran', ['id_pembayaran' => $id_pembayaran])->row_array();
		return $query['id_tagihan'];
	}

	public function tambahPembayaran($idpembayaran, $idtagihan, $idpelanggan, $totalbayar, $idbank, $bulan, $tahun){
		date_default_timezone_set('Asia/Jakarta');

		$date = getdate();
		$sekarang =  $date['year'].'/'.$date['mon'].'/'.$date['mday'].' '.$date['hours'].':'.$date['minutes'].':'.$date['seconds'];
		$bulanygdibayar = $bulan.'/'.$tahun;
		$data = array(
			'id_pembayaran' => $idpembayaran,
			'id_tagihan' => $idtagihan,
			'id_pelanggan' => $idpelanggan,
			'tanggal_pembayaran' => $sekarang,
			'bulan_bayar' => $bulanygdibayar,
			'biaya_admin' => 2000,
			'total_bayar' => $totalbayar,
			'id_bank' => $idbank
		);

		$this->db->insert('pembayaran', $data);
	}
}