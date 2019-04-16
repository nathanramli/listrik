<?php 


class FungsiTambahan extends CI_model
{
	public function cariIdkosong($tabel){

		for ($id=1; $id < 1000; $id++) { 
			$query = $this->db->get_where($tabel, ['id_'.$tabel => $id])->row_array();
			if ($query == false) {
				return $id;
				break;
			}
		}
	}


}

?>