<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Zakaznici_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}



	function ZobrazCestuSpravne($id=""){
		if(!empty($id)){
			$this->db->select('zakaznici.id, zakaznici.platba, CONCAT(cesty.trasa," , ", cesty.datum) AS cela_cesta')
				->from('cesty')
				->join('zakaznici', 'cesty.id = zakaznici.id_cesty')
				->where('zakaznici.id',$id);
			$query = $this->db->get();
			return $query->row_array();
		}else{
			$this->db->select('zakaznici.id, zakaznici.platba, CONCAT(cesty.trasa," , ", cesty.datum) AS cela_cesta')
				->from('cesty')
				->join('zakaznici', 'cesty.id = zakaznici.id_cesty');
			$this->db->limit(5,$this->uri->segment(3));
			$query = $this->db->get();
			return $query->result_array();
		}

	}

	//  naplnenie selectu z tabulky studenti
	public function NaplnDropdownCesty($id = ""){
		$this->db->order_by('trasa')
			->select('id, CONCAT(trasa," , ", datum) AS cela_cesta')
			->from('cesty');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$dropdowns = $query->result();
			foreach ($dropdowns as $dropdown)
			{
				$dropdownlist[$dropdown->id] = $dropdown->cela_cesta;
			}
			$dropdownlist[''] = 'Vyberte cestu';
			return $dropdownlist;
		}
	}

	// vlozenie zaznamu
	public function insert($data = array()) {
		$insert = $this->db->insert('zakaznici', $data);
		if($insert){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}

	// aktualizacia zaznamu
	public function update($data, $id) {
		if(!empty($data) && !empty($id)){
			$update = $this->db->update('zakaznici', $data, array('id'=>$id));
			return $update?true:false;
		}else{
			return false;
		}
	}

	// odstranenie zaznamu
	public function delete($id){
		$delete = $this->db->delete('zakaznici',array('id'=>$id));
		return $delete?true:false;
	}
	function getMesiacZakaznik(){
		return $this->db->query('
	SELECT CONCAT(MONTH(cesty.datum),\'/\',YEAR(cesty.datum)) as mesiac, COUNT(zakaznici.id) as pocet FROM `zakaznici`
	 INNER JOIN cesty ON cesty.id=zakaznici.id_cesty GROUP BY mesiac')->result_array();
	}

}

