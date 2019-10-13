<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgetpassword extends MY_Controller {
	
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
			$this->load->view('forgetPassword/forget_layout');
		}
	}

	public function checkMail()
	{
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required',
				'errors' => array(
                	'required' => 'ইউজার নেম পূরণ করুন',
                ),
			),
		);

		$this->form_validation->set_rules($validate_data);
	 
		if($this->form_validation->run() === true) {
			
			$mail = $this->model_login->checkMail();
			
			if($mail['pass']) {
				$validator['success'] = true;
				$validator['messages'] = base_url('checkpasscode');
				$mail_id = $mail['id'];
				$this->session->set_flashdata('mail_id', $mail_id);
			}
			else {
				$validator['success'] = false;
				$validator['messages'] = "ভুল ইউজার নেম";
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
}