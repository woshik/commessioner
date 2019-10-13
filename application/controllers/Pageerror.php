<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pageerror extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('pageError/404');
	}
}