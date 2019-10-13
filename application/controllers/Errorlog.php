<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errorlog extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_dashboard');
	}

	public function index()
	{
		if($this->isLoggedIn()) {
		 	if($this->session->userdata('account_access') == true) {
		 		
		 		if (!($this->session->userdata('id') == 1)) {
					redirect(base_url('dashboard'));
				}

				$userInfo = $this->model_dashboard->fatchAdminData($this->session->userdata('id'));

				$data = array("page_section" => "Error Log", "toggle" => "active", 'userInfo' => $userInfo);
				$this->load->view('dashboard_layout',$data);
			}
		}
		else {
			redirect(base_url('login/?logged_in_first'));
		}
	}

	public function showError()
	{
		if (!($this->session->userdata('id') == 1)) {
			redirect(base_url('dashboard'));
		}

		$this->db->select('sms_error_log, time');
		$query = $this->db->get('sms_error_log');
		$error = $query->result_array();

		echo json_encode($error);
	}

	public function logClear()
	{
		if (!($this->session->userdata('id') == 1)) {
			redirect(base_url('dashboard'));
		}

		$valid['pass'] = false;
		$status = $this->db->empty_table('sms_error_log');

		if ($status) {
			$valid['pass'] = true;
		}

		echo json_encode($valid);
	}
}