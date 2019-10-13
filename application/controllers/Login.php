<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		// loading the login model
		$this->load->model('model_login');
	}

	public function index()
	{
		if($this->isLoggedIn()) {
			redirect('dashboard');
		}
		else {
			$this->load->view('login_layout');
		}
	}
	 public function user_check()
	 {
		$validator = array('success' => false, 'messages' => array());

		 $validate_data = array(
			array(
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required',
				'errors'	=> array(
					'required' => 'ইউজার নেম প্রবেশ করান',
				),
			),
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required',
				'errors'	=> array(
					'required' => 'পাসওয়ার্ড প্রবেশ করান',
				),
			)
		);

		$this->form_validation->set_rules($validate_data);
	 
		if($this->form_validation->run() === true) {
			
			$login = $this->model_login->login();
			
			if($login) {
				$validator['success'] = true;
				$validator['messages'] = base_url('dashboard');
			}
			else {
				$validator['success'] = false;
				$validator['messages'] = "ভুল ইউজার নেম/পাসওয়ার্ড";
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
	

	public function logout()
	{
		$sess_data = array('id', 'account_access');
		$this->session->unset_userdata($sess_data);
		$this->session->sess_destroy();
		
		redirect(base_url('login/?logout=success'));
	}
}
