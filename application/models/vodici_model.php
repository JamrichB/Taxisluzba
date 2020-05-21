<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Vodici_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}



	function ZobrazVodicaSpravne($id=""){
		if(!empty($id)){
			$this->db->select('vodici.id_vodici, vodici.meno, vodici.priezvisko, CONCAT(auto.znacka," ", auto.model) AS cele_auto')
				->from('vodici')
				->join('auto', 'vodici.id_auto = auto.id_auto')
				->where('auto.id_auto',$id);
			$query = $this->db->get();
			return $query->row_array();
		}else{
			$this->db->select('vodici.id_vodici, vodici.meno, vodici.priezvisko, CONCAT(auto.znacka," ", auto.model) AS cele_auto')
				->from('vodici')
				->join('auto', 'vodici.id_auto = auto.id_auto');
			$query = $this->db->get();
			return $query->result_array();
		}

	}

	//  naplnenie selectu z tabulky studenti
	public function NaplnDropdownAuta($id = ""){
		$this->db->order_by('model')
			->select('id_auto, CONCAT(znacka," ", model) AS cele_auto')
			->from('auto');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$dropdowns = $query->result();
			foreach ($dropdowns as $dropdown)
			{
				$dropdownlist[$dropdown->id_auto] = $dropdown->cele_auto;
			}
			$dropdownlist[''] = 'Vyberte auto';
			return $dropdownlist;
		}
	}

	// vlozenie zaznamu
	public function insert($data = array()) {
		$insert = $this->db->insert('vodici', $data);
		if($insert){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}

	// aktualizacia zaznamu
	public function update($data, $id) {
		if(!empty($data) && !empty($id)){
			$update = $this->db->update('vodici', $data, array('id_vodici'=>$id));
			return $update?true:false;
		}else{
			return false;
		}
	}

	// odstranenie zaznamu
	public function delete($id){
		$delete = $this->db->delete('vodici',array('id_vodici'=>$id));
		return $delete?true:false;
	}

}


