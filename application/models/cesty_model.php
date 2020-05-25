<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cesty_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}



	function ZobrazVodicaSpravne($id=""){
		if(!empty($id)){
			$this->db->select('cesty.id, cesty.datum, cesty.trasa, cesty.pocet_km, CONCAT(vodici.meno," ", vodici.priezvisko) AS cely_vodic')
				->from('vodici')
				->join('cesty', 'vodici.id = cesty.id_vodici')
				->where('cesty.id',$id);
			$query = $this->db->get();
			return $query->row_array();
		}else{
			$this->db->select('cesty.id, cesty.datum, cesty.trasa, cesty.pocet_km, CONCAT(vodici.meno," ", vodici.priezvisko) AS cely_vodic')
				->from('vodici')
				->join('cesty', 'vodici.id = cesty.id_vodici');
			$this->db->limit(5,$this->uri->segment(3));
			$query = $this->db->get();
			return $query->result_array();
		}
	}




	//  naplnenie selectu z tabulky studenti
	public function NaplnDropdownVodici($id = ""){
		$this->db->order_by('priezvisko')
			->select('id, CONCAT(meno," ", priezvisko) AS cely_vodic')
			->from('vodici');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$dropdowns = $query->result();
			foreach ($dropdowns as $dropdown)
			{
				$dropdownlist[$dropdown->id] = $dropdown->cely_vodic;
			}
			$dropdownlist[''] = 'Vyberte vodiča';
			return $dropdownlist;
		}
	}

	// vlozenie zaznamu
	public function insert($data = array()) {
		$insert = $this->db->insert('cesty', $data);
		if($insert){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}

	// aktualizacia zaznamu
	public function update($data, $id) {
		if(!empty($data) && !empty($id)){
			$update = $this->db->update('cesty', $data, array('id'=>$id));
			return $update?true:false;
		}else{
			return false;
		}
	}

	// odstranenie zaznamu
	public function delete($id){
		$delete = $this->db->delete('cesty',array('id'=>$id));
		return $delete?true:false;
	}

	function getCenaCesty(){
		return $this->db->query('
		SELECT cesty.trasa AS cesta , ROUND(SUM(zakaznici.platba)) AS cena FROM `zakaznici`
		JOIN cesty ON cesty.id=zakaznici.id_cesty GROUP BY cesty.trasa')->result_array();
	}
}



