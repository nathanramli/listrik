<?php

class Data_admin extends CI_model{

	public function getAllAdmin(){
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->join('level', 'level.id_level = admin.id_level');
		return $this->db->get()->result_array();
	}

	public function jumlahSemuaAdmin(){
		return $this->db->count_all_results('admin'); 
	}

	public function tambahAdmin($idadmin, $username, $password, $namaadmin, $idlevel){
		$data = array(
			'id_admin' => $idadmin,
			'username' => $username,
			'password' => $password,
			'nama_admin' => $namaadmin,
			'id_level' => $idlevel
		);

		$this->db->insert('admin', $data);
	}	

	public function hapusAdminById($id){
		return $this->db->delete('admin', array('id_admin' => $id));
	}

	public function getAdminByID($id){
		return $this->db->get_where('admin', ['id_admin' => $id])->result();
	}

	public function editAdminByID($id_admin, $username, $password, $namaadmin, $id_level){
		$data = array(
			'username' => $username,
			'password' => $password,
			'nama_admin' => $namaadmin,
			'id_level' => $id_level
		);		

		$this->db->where('id_admin', $id_admin);
		$this->db->update('admin', $data);			
	}

}