<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Vodici extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Vodici_model');
	}
	public function index(){
		$data = array();

		//ziskanie sprav zo session
		if($this->session->userdata('success_msg')){
			$data['success_msg'] = $this->session->userdata('success_msg');
			$this->session->unset_userdata('success_msg');
		}
		if($this->session->userdata('error_msg')){
			$data['error_msg'] = $this->session->userdata('error_msg');
			$this->session->unset_userdata('error_msg');
		}


		$data['vodici'] = $this->Vodici_model->ZobrazVodicaSpravne();
		$data['title'] = 'Zoznam vodičov';
		//nahratie zoznamu studentov
		$this->load->view('templates/header', $data);
		$this->load->view('vodici/index', $data);
		$this->load->view('templates/footer');
	}

	// Zobrazenie detailu o znamke
	public function view($id){
		$data = array();

		//kontrola, ci bolo zaslane id riadka
		if(!empty($id)){
			$data['vodici'] = $this->Vodici_model->ZobrazVodicaSpravne($id);
			$data['title'] = 'Detail vodič';

			//nahratie detailu zaznamu
			$this->load->view('templates/header', $data);
			$this->load->view('vodici/view', $data);
			$this->load->view('templates/footer');
		}else{
			redirect('/vodici');
		}
	}

	// pridanie zaznamu o znamke
	public function add(){
		$data = array();
		$postData = array();

		//zistenie, ci bola zaslana poziadavka na pridanie zazanmu
		if($this->input->post('postSubmit')){
			//definicia pravidiel validacie
			$this->form_validation->set_rules('meno', 'Pole meno', 'required');
			$this->form_validation->set_rules('priezvisko', 'Pole priezvisko', 'required');
			$this->form_validation->set_rules('id_auto', 'Pole auta', 'required');

			//priprava dat pre vlozenie
			$postData = array(
				'meno' => $this->input->post('meno'),
				'priezvisko' => $this->input->post('priezvisko'),
				'id_auto' => $this->input->post('id_auto'),
			);

			//validacia zaslanych dat
			if($this->form_validation->run() == true){
				//vlozenie dat
				$insert = $this->Vodici_model->insert($postData);

				if($insert){
					$this->session->set_userdata('success_msg', 'Záznam o vodičovi bol úspešne vložený');
					redirect('/vodici');
				}else{
					$data['error_msg'] = 'Nastal problém.';
				}
			}
		}
		$data['post'] = $postData;
		$data['auto'] = $this->Vodici_model->NaplnDropdownAuta();
		$data['vybrane_auto'] = '';
		$data['title'] = 'Pridať vodiča';
		$data['action'] = 'add';

		//zobrazenie formulara pre vlozenie a editaciu dat
		$this->load->view('templates/header', $data);
		$this->load->view('vodici/add-edit', $data);
		$this->load->view('templates/footer');
	}

	// aktualizacia dat o znamke
	public function edit($id){
		$data = array();
		//ziskanie dat z tabulky
		$postData = $this->Vodici_model->ZobrazVodicaSpravne($id);

		//zistenie, ci bola zaslana poziadavka na aktualizaciu
		if($this->input->post('postSubmit')){
			//definicia pravidiel validacie
			$this->form_validation->set_rules('meno', 'Pole meno', 'required');
			$this->form_validation->set_rules('priezvisko', 'Pole priezvisko', 'required');
			$this->form_validation->set_rules('id_auto', 'Pole auta', 'required');

			//priprava dat pre vlozenie
			$postData = array(
				'meno' => $this->input->post('meno'),
				'priezvisko' => $this->input->post('priezvisko'),
				'id_auto' => $this->input->post('id_auto'),
			);

			//validacia zaslanych dat
			if($this->form_validation->run() == true){
				//aktualizacia dat
				$update = $this->Vodici_model->update($postData, $id);

				if($update){
					$this->session->set_userdata('success_msg', 'Záznam o vodicovi bol aktualizovaný.');
					redirect('/vodici');
				}else{
					$data['error_msg'] = 'Nastal problém.';
				}
			}
		}

		$data['auto'] = $this->Vodici_model->NaplnDropdownAuta();
		$data['vybrane_auto'] = $postData['idstudent'];
		$data['post'] = $postData;
		$data['title'] = 'Aktualizovať údaje';
		$data['action'] = 'edit';

		//zobrazenie formulara pre vlozenie a editaciu dat
		$this->load->view('templates/header', $data);
		$this->load->view('vodici/add-edit', $data);
		$this->load->view('templates/footer');
	}

	// odstranenie dat o znamke
	public function delete($id){
		//overenie, ci id nie je prazdne
		if($id){
			//odstranenie zaznamu
			$delete = $this->Vodici_model->delete($id);

			if($delete){
				$this->session->set_userdata('success_msg', 'Záznam bol odstránený.');
			}else{
				$this->session->set_userdata('error_msg', 'Záznam sa nepodarilo odstrániť.');
			}
		}

		redirect('/vodici');
	}
}
