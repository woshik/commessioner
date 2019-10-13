<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		// loading the mail model	
		$this->load->model('model_mail');
		// loading the mail box model	
		$this->load->model('model_mailbox');
	}

	public function index()
	{
		if($this->isLoggedIn()) {
			$data = array("page_section"=>"ই-মেইল ও এস.এম.এস পাঠান", "toggle"=>"active", 'userInfo'=>$this->userInfo);
			$this->load->view('dashboard_layout',$data);
		}
		else {
			redirect(base_url('login/?logged_in_first'));
		}
	}

	public function sentBox()
	{
		if($this->isLoggedIn()) {
			$data = array("page_section" => "ই-মেইল ও এস.এম.এস বক্স", "toggle" => "active", 'userInfo' => $this->userInfo);
			$this->load->view('dashboard_layout',$data);
		}
		else {
			redirect(base_url('login/?logged_in_first'));
		}
	}

	public function createStuff()
	{
		if (!($this->session->userdata('id') == 1)) {
			redirect(base_url('dashboard'));
		}

		$validator = array('success' => false, 'messages' => array());
		
		$validate_data = array(
			array(
				'field' => 'stuffName',
				'label' => 'stuffName',
				'rules' => 'required',
				'errors' => array(
                	'required' => 'নাম পূরণ করুন',
                ),
			),
			array(
				'field' => 'stuffPhone',
				'label' => 'stuffPhone',
				'rules' => 'required|is_unique[stuff.stuff_phone]',
				'errors' => array(
                	'required' => 'ফোন নম্বর পূরণ করুন ।',
                	'is_unique'	=> 'এই ফোন নম্বর অন্য কেউ ব্যবহার করছে, অনুগ্রহ করে ফোন নম্বর পরিবর্তন করুন'
                ),
			),
			array(
				'field' => 'stuffEmail',
				'label' => 'stuffEmail',
				'rules' => 'required|valid_email|is_unique[stuff.stuff_email]',
				'errors'=> array(
                	'required' 		=> 'ই-মেইল অ্যাড্রেস পূরণ করুন',
                	'valid_email'	=> 'সঠিক ই-মেইল দ্বারা পূরণ করুন',
                	'is_unique'		=> 'এই ই-মেইল অন্য কেউ ব্যবহার করছে, অনুগ্রহ করে ই-মেইল পরিবর্তন করুন'
                ),
			),
		);

		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true) {
			$imgUrl = $this->uploadImage();
			$create = $this->model_mail->create($imgUrl);				
			if($create === true) {
				$validator['success'] = true;
				$validator['messages'] = "তথ্য যুক্ত করা হয়েচ্ছে";
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

	public function fatchStuffData($id=null)
	{
		$fetch_data = $this->model_mail->make_datatables();  
       	$data = array();
       	
       	$x = 1;
       	foreach($fetch_data as $row)  
       	{
			$img = '<a href="'.base_url(html_entity_decode($row->stuff_priture)).'" data-lightbox="image-'.$x.'" data-title="Picture">
						<img src="'.base_url(html_entity_decode($row->stuff_priture)).'" id="staffAvatorPhoto">
					</a>';
			$hiddenId = '<input type="hidden" value="'.$row->stuff_id.'"/>';
            $sub_array = array();
            $sub_array[] = $img;  
            $sub_array[] = $row->stuff_name;  
            $sub_array[] = $row->stuff_phone;
            $sub_array[] = $row->stuff_email;
            $sub_array[] = $row->stuff_address.$hiddenId;
            $data[] = $sub_array;

            $x++;

       	}
       	$output = array(  
            "draw"				=> intval($_GET["draw"]),  
            "recordsTotal"		=> $this->model_mail->get_all_data(),  
            "recordsFiltered"	=> $this->model_mail->get_filtered_data(),  
            "data"				=> $data  
       	);  

       echo json_encode($output);
	}

	public function remove($id=null)
	{
		if (!($this->session->userdata('id') == 1)) {
			redirect(base_url('dashboard'));
		}

		if ($id) {
			$this->model_mail->remove($id);
		}
	}

	public function sendEmail()
	{
		$validator = array('success' => false, 'messages' => array());
		
		$validate_data = array(
			array(
				'field' => 'emailAddress',
				'label' => 'Email Address',
				'rules' => 'required',
			),
		);

		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true) {
			$file = $this->upload_file();

			if (empty($file['fail'])) {
				$data = array(
					'emailAddress' 	=> trim($this->input->post('emailAddress')),
					'emailSubject' 	=> trim($this->input->post('emailSubject')),
					'emailBody' 	=> trim($this->input->post('emailBody'))
				);

				$save = $this->model_mail->saveEmail($file['success'], $data, $this->userInfo);

				if ($save['success']) {

					if ($save['error'] == '') {
						$validator['success'] = true;
						$validator['messages'] = "সফল ভাবে ই-মেইল পাঠানো হয়েচ্ছে";
					}else{
						$validator['success'] = true;
						$validator['messages'] = "সফল ভাবে ই-মেইল পাঠানো হয়েচ্ছে । শুধু মাএ ".$save['error']."এই অ্যাড্রেসে ই-মেইল যাইনি । পুনরায় চেষ্টা করুন";
					}
					
				}
				else{
					$validator['success'] = false;
					$validator['messages'] = "ডাটাবেজের সমস্যার করনে ই-মেইল পাঠানো যাচ্ছে না, পুনরায় চেষ্টা করুন";
				}
				
			}
			else{
				$validator['success'] = false;
				$validator['messages'] = $file['fail'][0];

				$this->load->helper("file");

				foreach ($file['success'] as $key => $value) {
					delete_files($value);
				}
			}	
		}
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);
			}			
		}

		echo json_encode($validator);
	}

	public function sendSMS()
	{
		$validator = array('success' => false, 'messages' => array());
		
		$validate_data = array(
			array(
				'field' => 'phoneNumber',
				'label' => 'Phone Number',
				'rules' => 'required',
			),
		);

		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true) {

			$save = $this->model_mail->sendSMS();

			if($save['success'] === true) {
				if ($save['error'] == '') {
					$validator['success'] = true;
					$validator['messages'] = "সফল ভাবে এস.এম.এস পাঠানো হয়েচ্ছে";
				}else{
					$validator['success'] = true;
					$validator['messages'] = "সফল ভাবে এস.এম.এস পাঠানো হয়েচ্ছে । শুধু মাএ ".$save['error']."এই অ্যাড্রেসে এস.এম.এস যাইনি । পুনরায় চেষ্টা করুন";
				}
			}
			else {
				$validator['success'] = false;
				$validator['messages'] = "কিছু সমস্যার করনে এস.এম.এস পাঠানো যাচ্ছে না, পুনরায় চেষ্টা করুন";
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

	public function uploadImage() 
	{
		$config['upload_path'] 		= 'upload/stuffPicture/';
		$config['allowed_types'] 	= 'gif|jpg|jpeg|png|JPG|GIF|JPEG|PNG';
		$config['file_name']		= md5(uniqid());
		$config['max_size']			= 5000;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('adminPhoto'))
        {
        	return strstr($this->upload->data('full_path'),'upload/stuffPicture/');
        }
        else
        {
        	return false;
        }
	}

	public function upload_file()
    {
    	$number_of_file = count($_FILES['emailFile']['name']);
    	$fullpath = array('success' => array(), 'fail' => array());

    	if ($number_of_file>0)
    	{
    		$file = $_FILES;
    		
    		for ($i=0; $i < $number_of_file ; $i++)
    		{
    			$_FILES['emailFile']['name'] 		= $file['emailFile']['name'][$i];
    			$_FILES['emailFile']['type'] 		= $file['emailFile']['type'][$i];
    			$_FILES['emailFile']['tmp_name']	= $file['emailFile']['tmp_name'][$i];
    			$_FILES['emailFile']['error'] 		= $file['emailFile']['error'][$i];
    			$_FILES['emailFile']['size'] 		= $file['emailFile']['size'][$i];

    			$config['upload_path'] 		= './upload/email/';
	   			$config['allowed_types'] 	= 'gif|jpg|jpeg|png|JPG|GIF|JPEG|PNG|pdf|txt|doc|docx|zip|rar|7z|xlsx|exe';
	   			$config['file_name']		= strtoupper(md5(uniqid(mt_rand(), true)));
	   			$config['max_size']			= 5000;

	   			$this->load->library('upload', $config);

	   			if ($this->upload->do_upload('emailFile'))
		        {
		        	array_push($fullpath['success'],$this->upload->data()['full_path']);
		        }
		        else
		        {
		        	array_push($fullpath['fail'],$this->upload->display_errors());
		        	return $fullpath;
		        }
    		}	
    	}
    	return $fullpath;
    }

    public function fatchEmailData($id=null)
    {
    	if ($id) {
    		
    	} else{
    		$fetch_data = $this->model_mailbox->make_email_datatables();  
	       	$data = array();
	       	
	       	foreach($fetch_data as $row)
	       	{
	       		$btn = '<button class="btn btn-primary">Show Email</button>';
	            $sub_array = array(); 
	            $sub_array[] = $row->stuff_email_address;  
	            $sub_array[] = $row->stuff_email_subject;
	            $sub_array[] = date_format(date_create($row->dateTime), 'd-m-Y h:i:sa');
	            $sub_array[] = $btn;
	            $data[] = $sub_array;
	       	}
	       	$output = array(  
	            "draw"				=> intval($_GET["draw"]),  
	            "recordsTotal"		=> $this->model_mailbox->get_email_all_data(),  
	            "recordsFiltered"	=> $this->model_mailbox->get_email_filtered_data(),  
	            "data"				=> $data,
	       	);  

	       echo json_encode($output);
    	}
    }

    public function fatchSMSData($id = null)
    {
    	if ($id) {
    		
    	} else{
    		$fetch_data = $this->model_mailbox->make_sms_datatables();  
	       	$data = array();
	       	
	       	foreach($fetch_data as $row)
	       	{
	            $btn = '<button class="btn btn-primary">Show Email</button>';
	            $sub_array = array(); 
	            $sub_array[] = $row->stuff_sms_phone;
	            $sub_array[] = $row->stuff_sms_body;
	            $sub_array[] = date_format(date_create($row->dateTime), 'd-m-Y h:i:sa');
	            $sub_array[] = $btn;
	            $data[] = $sub_array;
	       	}
	       	$output = array(  
	            "draw"				=> intval($_GET["draw"]),  
	            "recordsTotal"		=> $this->model_mailbox->get_sms_all_data(),  
	            "recordsFiltered"	=> $this->model_mailbox->get_sms_filtered_data(),  
	            "data"				=> $data  
	       	);  

	       echo json_encode($output);
    	}
    }
}