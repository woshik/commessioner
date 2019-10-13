<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Changepassword extends MY_Controller {
	
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
			$id = $this->session->flashdata('item');

			if ($id) {
				$data = array('id' => $id);
				$this->load->view('forgetPassword/changepassword_layout', $data);
			}else{
				redirect(base_url('forgetpassword'));
			}	
		}
	}

	public function changePassword()
	{
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'newpass',
				'label' => 'New Password',
				'rules' => 'required|min_length[8]',
				'errors' => array(
                	'required' 		=> 'সবগুলো ঘর পূরণ করুন',
                	'min_length'	=> 'সর্বনিম্ন ৮টি অক্ষর হতে হবে' 
                ),
			),

			array(
				'field' => 'confirmPass',
				'label' => 'Confirm Password',
				'rules' => 'required|matches[newpass]',
				'errors' => array(
					'required' 		=> 'সবগুলো ঘর পূরণ করুন',
                	'matches' => 'নতুন পাসওয়ার্ডের সাথে কনফার্ম পাসওয়ার্ড মিলছে না',
                ),
			),
		);

		$this->form_validation->set_rules($validate_data);
	 
		if($this->form_validation->run() === true) {
			
			$change = $this->model_login->changePassword();
			
			if($change) {
				$validator['success'] = true;
				$validator['messages'] = base_url('login');
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