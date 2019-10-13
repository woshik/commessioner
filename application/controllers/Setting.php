<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		// loading setting model
		$this->load->model('model_setting');
	}

	public function index()
	{
		if($this->isLoggedIn()) {
		 	
	 		if ($this->session->userdata('id') != 1) {
				redirect(base_url('dashboard'));
			}

			$data = array("page_section" => "সেটিংস", "toggle" => "active", 'userInfo' => $this->userInfo);
			$this->load->view('dashboard_layout',$data);
			
		}
		else {
			redirect(base_url('login/?logged_in_first'));
		}
	}

	public function smsUpdate()
	{

		if ($this->session->userdata('id') != 1) {
			redirect(base_url('dashboard'));
		}

		$validator = array('success' => false, 'messages' => array());
		$validate_data = array(
			array(
				'field' => 'smsAccountId',
				'label' => 'SMS Id',
				'rules' => 'required',
			),
			array(
				'field' => 'smsAccountPassword',
				'label' => 'SMS Password',
				'rules' => 'required',
			),
		);

		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true) {
			
			$bulk_sms = array (
				'id' 			=> htmlentities(trim($this->input->post('smsAccountId'))),
				'password'		=> htmlentities(trim($this->input->post('smsAccountPassword'))),
			);	

			$this->db->where('bulk_sms_id', 1);
			$bulk_sms_result = $this->db->update('bulk_sms', $bulk_sms);

			if ($bulk_sms_result === true) {
				$validator['success'] = true;
				$validator['messages'] = "Successful";
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

	public function createUser()
	{

		if ($this->session->userdata('id') != 1) {
			redirect(base_url('dashboard'));
		}

		$validator = array('success' => false, 'messages' => array());
		$validate_data = array(
			array(
				'field' => 'createAccountName',
				'label' => 'Name',
				'rules' => 'required',
				'errors' => array(
                		'required' => 'নাম পূরণ করুন ।',
                ),
			),
			array(
				'field' => 'createAccountEmail',
				'label' => 'Email',
				'rules' => 'required|valid_email|is_unique[login.email]',
				'errors' => array(
                		'required' 		=> 'ই-মেইল পূরণ করুন',
                		'valid_email'	=> 'সঠিক ই-মেইল দ্বারা পূরণ করুন',
                		'is_unique'		=> 'এই ই-মেইল অন্য কেউ ব্যবহার করছে, অনুগ্রহ করে ই-মেইল পরিবর্তন করুন'
                ),
			),
			array(
				'field' => 'createAccountUserName',
				'label' => 'User Name',
				'rules' => 'required|is_unique[login.username]',
				'errors' => array(
                		'required' => 'ইউজার নেম পূরণ করুন',
                		'is_unique' => 'এই ইউজার নেম অন্য কেউ ব্যবহার করছে, অনুগ্রহ করে ইউজার নেম পরিবর্তন করুন'
                ),
			),
			array(
				'field' => 'createAccountPassword',
				'label' => 'Password',
				'rules' => 'required|min_length[8]',
				'errors' => array(
                		'required' => 'পাসওয়ার্ড পূরণ করুন ।',
                		'min_length' => 'সর্বনিম্ন ৮টি অক্ষর হতে হবে',
                ),
			),
			array(
				'field' => 'createAccountCnPassword',
				'label' => 'Confirm Password',
				'rules' => 'trim|required|matches[createAccountPassword]',
				'errors' => array(
                		'required' => 'কনফার্ম পাসওয়ার্ড পূরণ করুন ।',
                		'matches' => 'পাসওয়ার্ডের সাথে কনফার্ম পাসওয়ার্ড মিলছে না',
                ),
			)
		);

		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true) {
			$update = $this->model_setting->createUser();					
			if($update === true) {
				$validator['success'] = true;
				$validator['messages'] = "নতুন ব্যবহারকারী যুক্ত হয়েছে";
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

	public function fatchUploadImg()
	{
		if ($this->session->userdata('id') != 1) {
			redirect(base_url('dashboard'));
		}

		$this->db->select('login_img_src');
		$query = $this->db->get('login_img');
		$result = $query->result_array();

		echo json_encode($result);
	}

	public function upload()
	{
		if ($this->session->userdata('id') != 1) {
			redirect(base_url('dashboard'));
		}

		$number_of_file = count($_FILES['picture']['name']);

    	if ($number_of_file>0)
    	{
    		$this->model_setting->unlink_photo();
    		$file = $_FILES;
    		for ($i=0; $i < $number_of_file ; $i++)
    		{
    			$_FILES['picture']['name'] 		= $file['picture']['name'][$i];
    			$_FILES['picture']['type'] 		= $file['picture']['type'][$i];
    			$_FILES['picture']['tmp_name']	= $file['picture']['tmp_name'][$i];
    			$_FILES['picture']['error'] 	= $file['picture']['error'][$i];
    			$_FILES['picture']['size'] 		= $file['picture']['size'][$i];

    			$config['upload_path'] 		= 'upload/loginPicture/';
	   			$config['allowed_types'] 	= 'gif|jpg|jpeg|png|JPG|GIF|JPEG|PNG';
	   			$config['file_name']		= strtoupper(md5(uniqid(mt_rand(), true)));
	   			$config['max_size']			= 5000;

	   			$this->load->library('upload', $config);

	   			if ($this->upload->do_upload('picture'))
		        {
		        	$this->model_setting->uploadImg(strstr($this->upload->data('full_path'),'upload/loginPicture/'));
		        }
    		}

    		redirect(base_url('setting'));
    	}
	}
}