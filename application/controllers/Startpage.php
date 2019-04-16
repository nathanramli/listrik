<?php

class Startpage extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Akun');

		if($this->session->has_userdata('idakun')){
			if($this->session->has_userdata('pangkat')){
				if($this->session->userdata('pangkat') === "admin")
					redirect('admin');
				elseif($this->session->userdata('pangkat') === "bank")
					redirect($this->session->userdata('bank'));
				elseif($this->session->userdata('pangkat') === "pelanggan")
					redirect('user');
			}
		}

	}

	public function index(){
		if(!empty($_POST)){

			$login = $this->Akun->checkLogin();

			if( $login === "pending" ){
				$this->session->set_flashdata('pending', true);
				redirect('startpage/index');
			}
			elseif( $login != false ){

				$this->session->set_userdata('pangkat', $login);
				if($this->session->userdata('pangkat') === 'admin') 
					redirect('admin');
				elseif($this->session->userdata('pangkat') === 'pelanggan')
					redirect('user');
				else
					redirect('bank');
			}
			else{
				$this->session->set_flashdata('gagal', true);
				redirect('startpage/index');
			}
		}
		$this->load->view('startpage/login');
	}

	public function register(){

		// cek jika ada data yang masuk
		if(!empty($_POST)){

			$register = $this->Akun->addUser();			

			if($register){
				$this->session->set_flashdata('register', "Berhasil");
				redirect('startpage/register');
			}
			else{
				$this->session->set_flashdata('register', "Gagal");
				redirect('startpage/register');
			}
		}

		$this->load->view('startpage/register');
	}

	public function check_availability(){

		if(!empty($this->input->post('username'))){	
			
			$username = htmlspecialchars($this->input->post('username'));

			// Kecepatan QUERY tetap sama

			$query = $this->db->get_where('pelanggan', ['username' => $username]);

			if($query->num_rows()){
//				echo '<i id="status" class="fa fa-times" style="color: red;"></i>';
				echo false;
			}else{
//				echo '<i id="status" class="fa fa-check" style="color: green;"></i>';
				echo true;
			}
		}

	}


}