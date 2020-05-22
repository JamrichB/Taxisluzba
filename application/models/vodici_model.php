<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Vodici_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}



	function ZobrazAutoSpravne($id=""){
		if(!empty($id)){
			$this->db->select('vodici.id, vodici.meno, vodici.priezvisko, CONCAT(auto.znacka," ", auto.model) AS cele_auto')
				->from('auto')
				->join('vodici', 'auto.id = vodici.id_auto')
				->where('vodici.id',$id);
			$query = $this->db->get();
			return $query->row_array();
		}else{
			$this->db->select('vodici.id, vodici.meno, vodici.priezvisko, CONCAT(auto.znacka," ", auto.model) AS cele_auto')
				->from('auto')
				->join('vodici', 'auto.id = vodici.id_auto');
			$query = $this->db->get();
			return $query->result_array();
		}

	}

	//  naplnenie selectu z tabulky studenti
	public function NaplnDropdownAuta($id = ""){
		$this->db->order_by('model')
			->select('id, CONCAT(znacka," ", model) AS cele_auto')
			->from('auto');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$dropdowns = $query->result();
			foreach ($dropdowns as $dropdown)
			{
				$dropdownlist[$dropdown->id] = $dropdown->cele_auto;
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
			$update = $this->db->update('vodici', $data, array('id'=>$id));
			return $update?true:false;
		}else{
			return false;
		}
	}

	// odstranenie zaznamu
	public function delete($id){
		$delete = $this->db->delete('vodici',array('id'=>$id));
		return $delete?true:false;
	}

}


