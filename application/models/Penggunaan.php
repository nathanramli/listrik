<?php

class Penggunaan extends CI_model{

	public function getAllPenggunaan(){
		return $this->db->get('penggunaan')->result_array();
	}

	public function jumlahPenggunaanByBulan($bulan){
		$this->db->where('bulan', $bulan);
		$this->db->from('penggunaan');
		return $this->db->count_all_results();				
	}

	public function getPenggunaanByID($id){
		return $this->db->get_where('penggunaan', ['id_penggunaan' => $id])->result();
	}

	public function getPenggunaanByIdPelanggan($id){
		$where = "CONCAT(date_part('year', now()), date_part('month', now())) > CONCAT( tahun, bulan)";
		$this->db->where($where);
		$this->db->where('id_pelanggan', $id);		
		return $this->db->get('penggunaan')->result_array();
	}

	public function getPenggunaanByIdPelangganAscBulan($id){
		$this->db->where('id_pelanggan', $id);		
		$this->db->order_by('CONCAT(tahun, bulan) DESC');
		return $this->db->get('penggunaan')->result_array();
	}

	public function hapusPenggunaanById($id){
		return $this->db->delete('penggunaan', array('id_penggunaan' => $id));
	}

	public function cariIDkosong(){

		for ($id=1; $id < 1000; $id++) { 
			$tempid = "PNGN" . str_pad($id, 4, "0", STR_PAD_LEFT);
			$query = $this->db->get_where('penggunaan', ['id_penggunaan' => $tempid])->row_array();
			if ($query == false) {
				return $tempid;
				break;
			}
		}

	}	

	public function tambahDataPenggunaan($id_pelanggan, $bulan, $tahun, $meterawal, $meterakhir, $getid = false){
		$id_penggunaan = $this->cariIDkosong();

		$data = array(
			'id_penggunaan' => $id_penggunaan,
			'id_pelanggan' => $id_pelanggan,
			'bulan' => $bulan,
			'tahun' => $tahun,
			'meter_awal' => $meterawal,
			'meter_akhir' => $meterakhir
		);

		$this->db->insert('penggunaan', $data);

		if($getid) return $id_penggunaan;
	}


	public function editPenggunaanById($id_penggunaan, $id_pelanggan, $bulan, $tahun, $meterawal, $meterakhir){
		$data = array(
			'id_pelanggan' => $id_pelanggan,
			'bulan' => $bulan,
			'tahun' => $tahun,
			'meter_awal' => $meterawal,
			'meter_akhir' => $meterakhir
		);		

		$this->db->where('id_penggunaan', $id_penggunaan);
		$this->db->update('penggunaan', $data);
	}


}