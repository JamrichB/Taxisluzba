<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cesty extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Cesty_model');
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


		$data['cesty'] = $this->Cesty_model->ZobrazVodicaSpravne();
		$data['title'] = 'Zoznam ciest';
		//nahratie zoznamu studentov
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('cesty/index', $data);
		$this->load->view('templates/footer');
	}

	// Zobrazenie detailu o znamke
	public function view($id){
		$data = array();

		//kontrola, ci bolo zaslane id riadka
		if(!empty($id)){
			$data['cesty'] = $this->Cesty_model->ZobrazVodicaSpravne($id);
			$data['title'] = 'Detail cesta';

			//nahratie detailu zaznamu
			$this->load->view('templates/header', $data);
			$this->load->view('cesty/view', $data);
			$this->load->view('templates/footer');
		}else{
			redirect('/cesty');
		}
	}

	// pridanie zaznamu o znamke
	public function add(){
		$data = array();
		$postData = array();

		//zistenie, ci bola zaslana poziadavka na pridanie zazanmu
		if($this->input->post('postSubmit')){
			//definicia pravidiel validacie
			$this->form_validation->set_rules('datum', 'Pole datum', 'required');
			$this->form_validation->set_rules('trasa', 'Pole trasa', 'required');
			$this->form_validation->set_rules('pocet_km', 'Pole pocet_km', 'required');
			$this->form_validation->set_rules('id_vodici', 'Pole vodici', 'required');

			//priprava dat pre vlozenie
			$postData = array(
				'datum' => $this->input->post('datum'),
				'trasa' => $this->input->post('trasa'),
				'pocet_km' => $this->input->post('pocet_km'),
				'id_vodici' => $this->input->post('id_vodici'),
			);

			//validacia zaslanych dat
			if($this->form_validation->run() == true){
				//vlozenie dat
				$insert = $this->Cesty_model->insert($postData);

				if($insert){
					$this->session->set_userdata('success_msg', 'Záznam o ceste bol úspešne vložený');
					redirect('/cesty');
				}else{
					$data['error_msg'] = 'Nastal problém.';
				}
			}
		}
		$data['post'] = $postData;
		$data['vodici'] = $this->Cesty_model->NaplnDropdownVodici();
		$data['vybrany_vodic'] = '';
		$data['title'] = 'Pridať cestu';
		$data['action'] = 'add';

		//zobrazenie formulara pre vlozenie a editaciu dat
		$this->load->view('templates/header', $data);
		$this->load->view('cesty/add-edit', $data);
		$this->load->view('templates/footer');
	}

	// aktualizacia dat o znamke
	public function edit($id){
		$data = array();
		//ziskanie dat z tabulky
		$postData = $this->Cesty_model->ZobrazVodicaSpravne($id);

		//zistenie, ci bola zaslana poziadavka na aktualizaciu
		if($this->input->post('postSubmit')){
			//definicia pravidiel validacie
			$this->form_validation->set_rules('datum', 'Pole datum', 'required');
			$this->form_validation->set_rules('trasa', 'Pole trasa', 'required');
			$this->form_validation->set_rules('pocet_km', 'Pole pocet_km', 'required');
			$this->form_validation->set_rules('id_vodici', 'Pole vodici', 'required');

			//priprava dat pre vlozenie
			$postData = array(
				'datum' => $this->input->post('datum'),
				'trasa' => $this->input->post('trasa'),
				'pocet_km' => $this->input->post('pocet_km'),
				'id_vodici' => $this->input->post('id_vodici'),
			);

			//validacia zaslanych dat
			if($this->form_validation->run() == true){
				//aktualizacia dat
				$update = $this->Cesty_model->update($postData, $id);

				if($update){
					$this->session->set_userdata('success_msg', 'Záznam o ceste bol aktualizovaný.');
					redirect('/cesty');
				}else{
					$data['error_msg'] = 'Nastal problém.';
				}
			}
		}

		$data['vodici'] = $this->Cesty_model->NaplnDropdownVodici();
		$data['vybrany_vodic'] = $postData['id_vodici'];
		$data['post'] = $postData;
		$data['title'] = 'Aktualizovať údaje';
		$data['action'] = 'edit';

		//zobrazenie formulara pre vlozenie a editaciu dat
		$this->load->view('templates/header', $data);
		$this->load->view('cesty/add-edit', $data);
		$this->load->view('templates/footer');
	}

	// odstranenie dat o znamke
	public function delete($id){
		//overenie, ci id nie je prazdne
		if($id){
			//odstranenie zaznamu
			$delete = $this->Cesty_model->delete($id);

			if($delete){
				$this->session->set_userdata('success_msg', 'Záznam bol odstránený.');
			}else{
				$this->session->set_userdata('error_msg', 'Záznam sa nepodarilo odstrániť.');
			}
		}

		redirect('/cesty');
	}
}
