<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if($this->isLoggedIn()) {

	 		$totalMamla = $this->model_dashboard->totalMamla();
	 		$todayMamla = $this->model_dashboard->todayMamla();
	 		$smsPending = ($this->model_dashboard->pending())*2;
	 		$balance = 0;
	 		try
			{
		 		$query = $this->db->get('bulk_sms');
				$bulk_sms = $query->row_array();

				$userName = $bulk_sms['id'];
				$passWord = $bulk_sms['password'];
				
				$this->load->library("SMSlibrary");
				$soapClient =  new nusoap_client("https://api2.onnorokomSMS.com/sendSMS.asmx?wsdl", 'wsdl');

				$paramArray = array ('userName' => $userName,'userPassword' => $passWord );
				$value = $soapClient->call("GetBalance", array($paramArray));
				$balance = $value['GetBalanceResult'];
			}catch (Exception $e) {
			    
			};

			$data = array("page_section" => "ড্যাশবোর্ড", "toggle" => "active", "totalMamla" => $totalMamla, "balance" => $balance, 'todayMamla' => $todayMamla, 'smsPending' => $smsPending, 'userInfo'=> $this->userInfo);
			$this->load->view('dashboard_layout',$data);
			
		}
		else {
			redirect(base_url('login/?logged_in_first'));
		}
	}

	public function fatchadmin()
	{
		$result = array (
			'name'			=> html_entity_decode($this->userInfo['name']),
			'image_src'		=> $this->userInfo['image_src'],
			'email'			=> html_entity_decode($this->userInfo['email']),
			'username' 		=> html_entity_decode($this->userInfo['username'])
		);

		echo json_encode($result);
	}

	public function updateAdminProfile()
	{
		$validator = array('success' => false, 'messages' => array());

		$userData = array(
			'id'				=> $this->session->userdata('id'),
			'image_src' 		=> $this->userInfo['image_src'],
			'adminCurrentPass'	=> trim($this->input->post('adminCurrentPass')),
			'adminNewPass'		=> trim($this->input->post('adminNewPass')),
			'adminConfirmPass'	=> trim($this->input->post('adminConfirmPass')),
		);

		if (!empty($userData['adminCurrentPass'])||!empty($userData['adminNewPass'])||!empty($userData['adminConfirmPass']))
		{
			$validate_data = array(
				array(
					'field' => 'adminname',
					'label' => 'Name',
					'rules' => 'required',
					'errors' => array(
                		'required' => 'নাম পূরণ করুন ।',
                	),
				),
				array(
					'field' => 'adminEmail',
					'label' => 'Email',
					'rules' => 'required|valid_email',
					'errors' => array(
                		'required' => 'ই-মেইল পূরণ করুন ।',
                		'valid_email'	=> 'সঠিক ই-মেইল দ্বারা পূরণ করুন'
                	),
				),
				array(
					'field' => 'adminCurrentPass',
					'label' => 'Current Password',
					'rules' => 'required|callback_validate_admin_current_password',
					'errors' => array(
                		'required' => 'বর্তমান পাসওয়ার্ড পূরণ করুন ।',
                	),
				),
				array(
					'field' => 'adminNewPass',
					'label' => 'New Password',
					'rules' => 'required|min_length[8]',
					'errors' => array(
                		'required' => 'নতুন পাসওয়ার্ড পূরণ করুন ।',
                		'min_length' => 'সর্বনিম্ন ৮টি অক্ষর হতে হবে',
                	),
				),
				array(
					'field' => 'adminConfirmPass',
					'label' => 'Confirm Password',
					'rules' => 'required|matches[adminNewPass]',
					'errors' => array(
                		'required' => 'কনফার্ম পাসওয়ার্ড পূরণ করুন ।',
                		'matches' => 'নতুন পাসওয়ার্ডের সাথে কনফার্ম পাসওয়ার্ড মিলছে না',
                	),
				)
			);
		}
		else{
			$validate_data = array(
				array(
					'field' => 'adminname',
					'label' => 'Name',
					'rules' => 'required',
					'errors' => array(
                		'required' => 'নাম পূরণ করুন ।',
                	),
				),
				array(
					'field' => 'adminEmail',
					'label' => 'Email',
					'rules' => 'required|valid_email',
					'errors' => array(
                		'required' => 'ই-মেইল পূরণ করুন ।',
                		'valid_email'	=> 'সঠিক ই-মেইল দ্বারা পূরণ করুন'
                	),
				)
			);
		}

		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true) {
			$imgUrl = $this->uploadImage();
			$update = $this->model_dashboard->updateAdminProfile($userData,$imgUrl);					
			if($update === true) {
				$validator['success'] = true;
			}
			else {
				$validator['success'] = false;
				$validator['messages'] = "কিছু সমস্যার করনে তথ্য ডাটাবেজ যাচ্ছে না, পুনরায় চেষ্টা করুন";
			}			
		} 	
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);
			}			
		} // /else

		echo json_encode($validator);
	}

	public function validate_admin_current_password()
	{
		$userId = $this->session->userdata('id');
		$validate = $this->model_dashboard->validate_admin_current_password($this->input->post('adminCurrentPass'), $userId);

		if($validate === true) {
			return true;
		} 
		else {
			$this->form_validation->set_message('validate_admin_current_password', 'বর্তমান পাসওয়ার্ড মিলছে না');
			return false;			
		} // /else	
	}

	public function uploadImage() 
	{
		$config['upload_path'] 		= 'upload/profilePicture/';
		$config['allowed_types'] 	= 'gif|jpg|jpeg|png|JPG|GIF|JPEG|PNG';
		$config['file_name']		= md5(uniqid());
		$config['max_size']			= 5000;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('adminPhoto'))
        {
        	return strstr($this->upload->data('full_path'),'upload/profilePicture/');
        }
        else
        {
        	return false;
        }
	}
}
