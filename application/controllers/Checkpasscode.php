<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkpasscode extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		// loading the dashboard model	
		$this->load->model('model_dashboard');
		// loading the login model	
		$this->load->model('model_login');
	}

	public function index()
	{
		if($this->isLoggedIn()) {

		 	if($this->session->userdata('account_access') == true) {
		 		redirect(base_url('dashboard'));
			}
		}
		else {
			$id = $this->session->flashdata('mail_id');

			if ($id) {
				$data = array('id' => $id);
				$this->load->view('forgetPassword/passcode_layout',$data);
			}else{
				redirect(base_url('forgetpassword'));
			}	
		}
	}

	public function checkcode()
	{
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'passcode',
				'label' => 'Passcode',
				'rules' => 'required',
				'errors' => array(
                	'required' => 'পাস কোড পূরণ করুন',
                ),
			),
		);

		$this->form_validation->set_rules($validate_data);
	 
		if($this->form_validation->run() === true) {
			
			$ck = $this->model_login->checkpasscode();
			
			if($ck['pass']) {
				$validator['success'] = true;
				$validator['messages'] = base_url('changepassword');
				$mail_id = $ck['id'];
				$this->session->set_flashdata('item', $mail_id);
			}
			else {
				$validator['success'] = false;
				$validator['messages'] = "ভুল পাস কোড";
			}

		}
		else{
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);
			}		
		}

		echo json_encode($validator);
	}

	public function resendCode()
	{
		$validator = array('success' => false, 'messages' => array());
		$id = htmlentities(trim($this->input->get('hiddenmailId')));

		if (!empty($id)) {
			$code = md5(uniqid());
			$recover_code = array(
				'recover_code'	=> $code,
			);

			$this->db->where('login_id', $id);
			$status = $this->db->update('login', $recover_code);

			if ($status == true) {
				$this->db->select('email');
				$this->db->where('login_id', $id);
				$query = $this->db->get('login');
				$login_data = $query->row_array();

				$this->model_login->sendMail($login_data, $code);

				if ($login_data == true) {
					$validator['success'] = true;
					$validator['messages'] = "পুনরায় কোড পাঠান হয়েছে";
				}
				echo json_encode($validator);
			}
		}
	}
}