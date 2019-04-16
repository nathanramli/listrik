<?php

class Data_bank extends CI_model{

	public function getAllBank(){
		return $this->db->get('bank')->result_array();
	}

}