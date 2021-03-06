<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auto_model extends CI_Model{

	public function __construct()
	{
		$this->load->database();
	}

	function getRows($id= ""){
		if (!empty($id)){
			$query = $this->db->get_where('auto',array('id'=> $id));
			return $query -> row_array();
		} else{
			$query = $this->db->get('auto','5',$this->uri->segment(3));
			return  $query->result_array();
		}
	}

	public function insert($data = array()){
		$insert = $this->db->insert('auto',$data);
		if ($insert){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}

	public function update($data,$id){
		if (!empty($data) && !empty($id)){
			$update = $this->db->update('auto',$data, array('id'=>$id));
			return $update?true:false;
		}else{
			return false;
		}
	}

	public function delete($id){
		$delete = $this->db->delete('auto',array('id'=>$id));
		return $delete?true:false;
	}
	function getZnackaZakaznik(){
		return $this->db->query('
		SELECT auto.znacka AS znacka, COUNT(zakaznici.id) as customer FROM `auto` 
		INNER JOIN vodici ON vodici.id_auto=auto.id INNER JOIN cesty ON cesty.id_vodici=vodici.id 
		INNER JOIN zakaznici ON zakaznici.id_cesty=cesty.id GROUP BY znacka')->result_array();
	}
}
