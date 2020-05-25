<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auto extends  CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Auto_model');
	}

	public function index(){
		$data = array();
		$data['charts']=$this->Auto_model->getZnackaZakaznik();

		$this->load->library('pagination');
		$query2=$this->db->get('auto');

		$config['base_url']=base_url().'index.php/auto/index';
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



		if ($this->session->userdata('success_msg')){
			$data['success_msg'] = $this->session->userdata('success_msg');
			$this->session->unset_userdata('success_msg');
		}
		if ($this->session->userdata('error_msg')){
			$data['error_msg'] = $this->session->userdata('error_msg');
			$this->session->unset_userdata('error_msq');
		}
		$data['auto'] = $this->Auto_model->getRows();
		$data['title'] = 'Zoznam áut';
		$title = $data['title'];
		//include 'templates/header.php';

		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar',$data);
		$this->load->view('auto/index',$data);
		$this->load->view('templates/footer');
	}

	public function view($id){
		$data = array();
		if (!empty($id)){
			$data['auto'] = $this->Auto_model->getRows($id);
			$data['title'] = $data['auto']['model'] . ' ' . $data['auto']['znacka'];
			$title = $data['title'];
			//include 'templates/header.php';

			$this->load->view('templates/header', $data);
			$this->load->view('auto/view',$data);
			$this->load->view('templates/footer');
		}else{
			redirect('/auto');
		}
	}
	public function add(){
		$data = array();
		$postData = array();
		if ($this->input->post('postSubmit')){
			$this->form_validation->set_rules('znacka','znacka','required');
			$this->form_validation->set_rules('model','model','required');

			$postData = array(
				'znacka'=>$this->input->post('znacka'),
				'model' =>$this->input->post('model'),
			);

			if ($this->form_validation->run() == true){
				$insert = $this->Auto_model->insert($postData);
				if ($insert){
					$this->session->set_userdata('success_msg','Auto bolo uspesne pridane.');
					redirect('/auto');
				}else {
					$data['error_msg'] = 'Nastal nejaky problem.';
				}
			}
		}

		$data['post']= $postData;

		$data['title'] = 'Pridať auto';
		$title = $data['title'];
		//include 'templates/header.php';
		$data['action']= 'add';
		//$action = $data['action'];

		$this->load->view('templates/header',$data);
		$this->load->view('auto/add-edit',$data);
		$this->load->view('templates/footer');

	}
	public function edit($id){
		$data = array();
		//ziskanie dat z tabulky
		$postData = $this->Auto_model->getRows($id);

		//zistenie, ci bola zaslana poziadavka na aktualizaciu
		if($this->input->post('postSubmit')){
			//definicia pravidiel validacie
			$this->form_validation->set_rules('znacka', 'Zadajte znacku', 'required');
			$this->form_validation->set_rules('model', 'Zadajte model', 'required');


			// priprava dat pre aktualizaciu
			$postData = array(
				'znacka' => $this->input->post('znacka'),
				'model' => $this->input->post('model')
			);

			//validacia zaslanych dat
			if($this->form_validation->run() == true){
				//aktualizacia dat
				$update = $this->Auto_model->update($postData, $id);

				if($update){
					$this->session->set_userdata('success_msg', 'Záznam o aute bol aktualizovaný.');
					redirect('/auto');
				}else{
					$data['error_msg'] = 'Nastal problém.';
				}
			}
		}

		//$data['users'] = $this->Temperatures_model->get_users_dropdown();
		//	$data['users_selected'] = $postData['user'];
		$data['post'] = $postData;
		$data['title'] = 'Aktualizovať údaje';
		$title = $data['title'];
		//include 'templates/header.php';
		$data['action'] = 'edit';
		//$action = $data['action'];

		//zobrazenie formulara pre vlozenie a editaciu dat
		$this->load->view('templates/header', $data);
		$this->load->view('auto/add-edit', $data);
		$this->load->view('templates/footer');
	}

	public function delete($id){
		if($id){
			$delete = $this->Auto_model->delete($id);
			if ($delete){
				$this->session->set_userdata('success_msg','Auto bolo uspecne zmazane.');

			}else{
				$this->session->set_userdata('error_msg','Nastal nejaky problem.');
			}
		}
		redirect('/auto');
	}
}
