<?php

class Tagihan extends CI_model{

	public function editTagihan( $id_penggunaan, $id_pelanggan, $bulan, $tahun, $jumlah_meter ){
		$id_tagihan = "BILL".substr($id_penggunaan, -4); // Ambil 4 karakter terakhir

		$data = array(
			'id_penggunaan' => $id_penggunaan,
			'id_pelanggan' => $id_pelanggan,
			'bulan' => $bulan,
			'tahun' => $tahun,
			'jumlah_meter' => $jumlah_meter
		);		

		$this->db->where('id_tagihan', $id_tagihan);
		$this->db->update('tagihan', $data);		
	}

	public function updateTagihan($id, $status){
		switch ($status) {
			case 'pending':
				$data = array('status' => "Pending");				
				$this->db->where('id_tagihan', $id);
				$this->db->update('tagihan', $data);		
				break;

			case 'lunas':
				$data = array('status' => "Lunas");				
				$this->db->where('id_tagihan', $id);
				$this->db->update('tagihan', $data);
				break;				

			case 'belum lunas':
				$data = array('status' => "Belum Lunas");				
				$this->db->where('id_tagihan', $id);
				$this->db->update('tagihan', $data);					
				break;
			
			default:
				throw new Exception("Error pada Method Update Tagihan", 1);				
				break;
		}

	}

	public function jumlahTagihan($tipe, $extra = null){
		switch ($tipe) {
			case 'tunggakan':
				$this->db->where('status', 'Belum Lunas');
				$this->db->from('tagihan');
				return $this->db->count_all_results();		
				break;
			
			case 'lunas':
				$this->db->where('status', 'Lunas');
				$this->db->from('tagihan');
				return $this->db->count_all_results();		
				break;

			case 'tagihan pelanggan':
				$this->db->where('id_pelanggan', $extra);
				$where = "CONCAT(date_part('year', now()), date_part('month', now())) > CONCAT(tahun, bulan)";
				$this->db->where($where);
				$this->db->where('status !=', 'Lunas');
				$this->db->from('tagihan');
				return $this->db->count_all_results();		
				break;		

			case 'lunas bulan':
				$this->db->where('status', 'Lunas');
				$this->db->where('bulan', $extra);
				$this->db->from('tagihan');
				return $this->db->count_all_results();		
				break;						

			default:
				throw new Exception("Error pada Method Jumlah Tagihan", 1);
				break;
		}
	}

	public function getAllTagihan(){
		return $this->db->get('tagihan')->result_array();
	}	


	public function getTunggakanByIdPelanggan($id){
		$this->db->where('id_pelanggan', $id);
		$this->db->where('status !=', 'Lunas');
		$where = "CONCAT(date_part('year', now()), date_part('month', now())) > CONCAT(tahun, bulan)";
		$this->db->where($where);
		return $this->db->get('tagihan')->result_array();
	}

	public function getIdTarifByIdPelanggan($id_pelanggan){
		$tarif = $this->db->get_where('pelanggan', ['id_pelanggan' => $id_pelanggan])->result_array();		
		return $tarif['id_tarif'];
	}

	public function getInfoTagihanFullById($idtagihan){
		$this->db->select('*');
		$this->db->from('tagihan');
		$this->db->join('pelanggan', "pelanggan.id_pelanggan = tagihan.id_pelanggan");
		$this->db->join('tarif', "tarif.id_tarif = pelanggan.id_tarif");
		$this->db->where(array('tagihan.id_tagihan' => $idtagihan));
		return $this->db->get()->result_array();
	}


	public function getTagihanByIdPelanggan($id){
		return $this->db->get_where('tagihan', ['id_pelanggan' => $id])->result_array();
	}

	public function tambahTagihan( $id_penggunaan,$id_pelanggan,$bulan,$tahun,$jumlah_meter ){
		// tahap kasih nomor kwh
		$id_tagihan = "BILL".substr($id_penggunaan, -4); // Ambil 4 karakter terakhir

		$data = array(
			'id_tagihan' => $id_tagihan,
			'id_penggunaan' => $id_penggunaan,
			'id_pelanggan' => $id_pelanggan,
			'bulan' => $bulan,
			'tahun' => $tahun,
			'jumlah_meter' => $jumlah_meter,
			'status' => "Belum Lunas"
		);

		$this->db->insert('tagihan', $data);		
	}

}