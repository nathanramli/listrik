<?php 

class Tarif extends CI_model{

	public function getAllTarif(){
		return $this->db->get('tarif')->result_array();
	}

	public function getTarifByID($id){
		return $this->db->get_where('tarif', ['id_tarif' => $id])->result();
	}

	public function hapusTarifById($id){
		return $this->db->delete('tarif', array('id_tarif' => $id));
	}

	public function tambahTarif( $idtarif ,$daya, $tarifperkwh){
		$data = array(
			'id_tarif' => $idtarif,
			'daya' => $daya,
			'tarifperkwh' => $tarifperkwh
		);

		$this->db->insert('tarif', $data);
	}

	public function editTarifByID($id_tarif, $daya, $tarifperkwh){
		$data = array(
			'id_tarif' => $id_tarif,
			'daya' => $daya,
			'tarifperkwh' => $tarifperkwh
		);		

		$this->db->where('id_tarif', $id_tarif);
		$this->db->update('tarif', $data);		
	}
}