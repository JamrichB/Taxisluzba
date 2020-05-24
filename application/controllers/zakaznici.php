<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Zakaznici extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Zakaznici_model');
	}
	public function index(){
		$data = array();

		$this->load->library('pagination');
		$query2=$this->db->get('zakaznici');

		$config['base_url']=base_url().'index.php/zakaznici/index';
		$config['total_rows']=$query2->num_rows();
		$config['per_page']=5;

		$config['full_tag_open']='<ul class="pagination">';
		$config['full_tag_close']='</ul>';

		$config['first_tag_open']='<li>';
		$config['last_tag_open']='<li>';

		$config['next_tag_open']='<li>';
		$config['prev_tag_open']='<li>';

		$config['num_tag_open']='<li>';
		$config['num_tag_close']='</li>';

		$config['first_tag_close']='</li>';
		$config['last_tag_close']='</li>';

		$config['next_tag_close']='</li>';
		$config['prev_tag_close']='</li>';

		$config['cur_tag_open']="<li class=\"active\"><span><b>";
		$config['cur_tag_close']="</b></span></li>";

		$this->pagination->initialize($config);

		//ziskanie sprav zo session
		if($this->session->userdata('success_msg')){
			$data['success_msg'] = $this->session->userdata('success_msg');
			$this->session->unset_userdata('success_msg');
		}
		if($this->session->userdata('error_msg')){
			$data['error_msg'] = $this->session->userdata('error_msg');
			$this->session->unset_userdata('error_msg');
		}


		$data['zakaznici'] = $this->Zakaznici_model->ZobrazCestuSpravne();
		$data['title'] = 'Zoznam zakaznikov';
		//nahratie zoznamu studentov
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('zakaznici/index', $data);
		$this->load->view('templates/footer');
	}

	// Zobrazenie detailu o znamke
	public function view($id){
		$data = array();

		//kontrola, ci bolo zaslane id riadka
		if(!empty($id)){
			$data['zakaznici'] = $this->Zakaznici_model->ZobrazCestuSpravne($id);
			$data['title'] = 'Detail zakaznik';

			//nahratie detailu zaznamu
			$this->load->view('templates/header', $data);
			$this->load->view('zakaznici/view', $data);
			$this->load->view('templates/footer');
		}else{
			redirect('/zakaznici');
		}
	}

	// pridanie zaznamu o znamke
	public function add(){
		$data = array();
		$postData = array();

		//zistenie, ci bola zaslana poziadavka na pridanie zazanmu
		if($this->input->post('postSubmit')){
			//definicia pravidiel validacie
			$this->form_validation->set_rules('platba', 'Pole platba', 'required');
			$this->form_validation->set_rules('id_cesty', 'Pole cesty', 'required');

			//priprava dat pre vlozenie
			$postData = array(
				'platba' => $this->input->post('platba'),
				'id_cesty' => $this->input->post('id_cesty'),
			);

			//validacia zaslanych dat
			if($this->form_validation->run() == true){
				//vlozenie dat
				$insert = $this->Zakaznici_model->insert($postData);

				if($insert){
					$this->session->set_userdata('success_msg', 'Záznam o zakaznikovi bol úspešne vložený');
					redirect('/zakaznici');
				}else{
					$data['error_msg'] = 'Nastal problém.';
				}
			}
		}
		$data['post'] = $postData;
		$data['cesty'] = $this->Zakaznici_model->NaplnDropdownCesty();
		$data['vybrana_cesta'] = '';
		$data['title'] = 'Pridať zakaznika';
		$data['action'] = 'add';

		//zobrazenie formulara pre vlozenie a editaciu dat
		$this->load->view('templates/header', $data);
		$this->load->view('zakaznici/add-edit', $data);
		$this->load->view('templates/footer');
	}

	// aktualizacia dat o znamke
	public function edit($id){
		$data = array();
		//ziskanie dat z tabulky
		$postData = $this->Zakaznici_model->ZobrazCestuSpravne($id);

		//zistenie, ci bola zaslana poziadavka na aktualizaciu
		if($this->input->post('postSubmit')){
			//definicia pravidiel validacie
			$this->form_validation->set_rules('platba', 'Pole platba', 'required');
			$this->form_validation->set_rules('id_cesty', 'Pole cesty', 'required');

			//priprava dat pre vlozenie
			$postData = array(
				'platba' => $this->input->post('platba'),
				'id_cesty' => $this->input->post('id_cesty'),
			);

			//validacia zaslanych dat
			if($this->form_validation->run() == true){
				//aktualizacia dat
				$update = $this->Zakaznici_model->update($postData, $id);

				if($update){
					$this->session->set_userdata('success_msg', 'Záznam o zákazníkovi bol aktualizovaný.');
					redirect('/zakaznici');
				}else{
					$data['error_msg'] = 'Nastal problém.';
				}
			}
		}

		$data['cesty'] = $this->Zakaznici_model->NaplnDropdownCesty();
		$data['vybrana_cesta'] = $postData['id_cesty'];
		$data['post'] = $postData;
		$data['title'] = 'Aktualizovať údaje';
		$data['action'] = 'edit';

		//zobrazenie formulara pre vlozenie a editaciu dat
		$this->load->view('templates/header', $data);
		$this->load->view('zakaznici/add-edit', $data);
		$this->load->view('templates/footer');
	}

	// odstranenie dat o znamke
	public function delete($id){
		//overenie, ci id nie je prazdne
		if($id){
			//odstranenie zaznamu
			$delete = $this->Zakaznici_model->delete($id);

			if($delete){
				$this->session->set_userdata('success_msg', 'Záznam bol odstránený.');
			}else{
				$this->session->set_userdata('error_msg', 'Záznam sa nepodarilo odstrániť.');
			}
		}

		redirect('/zakaznici');
	}
}
