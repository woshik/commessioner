<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	protected $userInfo;

	public function __construct()
	{
		parent::__construct();
		// loading the dashboard model	
		$this->load->model('model_dashboard');
		// loading the time	
		date_default_timezone_set("Asia/Dhaka");

		$this->userInfo = $this->model_dashboard->fatchAdminData($this->session->userdata('id'));
	}
	
	protected function isLoggedIn()
	{
		return ($this->session->userdata('account_access') === TRUE) ;
	}

}
