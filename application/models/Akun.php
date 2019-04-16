<?php

class Akun extends CI_model {

	public function checkLogin(){

		$username = htmlspecialchars($this->input->post('username'));
		$password = htmlspecialchars($this->input->post('password'));

		$password = md5(GARAM.$password);

		$user = $this->db->get_where('pelanggan', ['username' => $username])->row_array();

		// Cek di tabel pelanggan
		if($user) {
			if ($user['password'] === $password) {
				if($user['status'] === "pending")
					return 'pending';
				else{
					$this->session->set_userdata('idakun', $user['id_pelanggan']);
					$this->session->set_userdata('pangkat', "pelanggan");
					$this->session->set_userdata('nama', $user['nama_pelanggan']);
					return 'pelanggan';
				}
			}
		}else{
			$user = $this->db->get_where('admin', ['username' => $username])->row_array();

			// Cek di tabel admin
			if($user){
				if ($user['password'] === $password) {
					$this->session->set_userdata('idakun', $user['id_admin']);
					$this->session->set_userdata('pangkat', "admin");
					$this->session->set_userdata('nama', $user['nama_admin']);
					$this->session->set_userdata('level', $user['id_level']);
					return 'admin';
				}
			}else{
				$user = $this->db->get_where('bank', ['username' => $username])->row_array();
				if( $user ){
					if ($user['password'] === $password) {
						$this->session->set_userdata('idakun', $user['id_bank']);
						$this->session->set_userdata('pangkat', "bank");
						$this->session->set_userdata('nama', $user['nama_bank']);
						return 'bank';
					}					
				}
			}
		}

	}

	public function jumlahSemuaPelanggan($status = null){

		if($status === "pending"){ 
			$this->db->where('status', 'pending');
			$this->db->from('pelanggan');
			return $this->db->count_all_results();				
		}else
			return $this->db->count_all_results('pelanggan'); 

	}

	public function cariIDkosong(){

		for ($id=1; $id < 1000; $id++) { 
			$tempid = "USER" . str_pad($id, 4, "0", STR_PAD_LEFT);
			$query = $this->db->get_where('pelanggan', ['id_pelanggan' => $tempid])->row_array();
			if ($query == false) {
				return $tempid;
				break;
			}
		}

	}

	public function getAllUser($status = null){
		if ($status === "verified") {
			$this->db->where('status', 'verified');
			return $this->db->get('pelanggan')->result_array();				
		}else
			return $this->db->get('pelanggan')->result_array();
	}

	public function getUserById($id){
		$this->db->where('id_pelanggan', $id);
		return $this->db->get('pelanggan')->result_array();				
	}

	public function addUser(){

		$nama = htmlspecialchars($this->input->post('nama'));

		$username = htmlspecialchars($this->input->post('username'));
		$password = htmlspecialchars($this->input->post('password'));
		$alamat = $this->input->post('alamat');

		$password = md5(GARAM.$password);

		$cek = $this->db->get_where('pelanggan', ['username' => $username])->row_array();

		if($cek) return false;

		$id = $this->cariIDkosong();

		$data = array(
			'id_pelanggan' => $id,
			'username' => $username,
			'password' => $password,
			'nomor_kwh' => NULL,
			'nama_pelanggan' => $nama,
			'alamat' => $alamat,
			'id_tarif' => NULL,
			'status' => 'pending'
		);

		$query = $this->db->insert('pelanggan', $data);

		if ($query) 
			return true;
		else 
			return false;

	}

	public function verifikasipelanggan($id, $tarif)
	{
		// tahap verifikasi

		$this->db->set('status', 'verified');
		$this->db->where('id_pelanggan', $id);
		$this->db->update('pelanggan');

		// tahap kasih nomor kwh
		$nomorkwh = "KWH".substr($id, -4); // Ambil 4 karakter terakhir

		$this->db->set('nomor_kwh', $nomorkwh);
		$this->db->set('id_tarif', $tarif);
		$this->db->where('id_pelanggan', $id);
		$this->db->update('pelanggan');

	}

}