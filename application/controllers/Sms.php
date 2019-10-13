<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		// loading the suit model	
		$this->load->model('model_suit');
		// loading the sms model	
		$this->load->model('model_sms');
	}

	public function index()
	{
		if($this->isLoggedIn()) {
			$data = array("page_section" => "এস.এম.এস", "toggle" => "active", 'userInfo' => $this->userInfo);
			$this->load->view('dashboard_layout',$data);
		}
		else {
			redirect(base_url('login/?logged_in_first'));
		}
	}

	public function fetchSmsData()
	{
		$fetch_data = $this->model_sms->make_datatables();  
        $data = array();

		foreach($fetch_data as $row)  
        {
			$checkBox = '<input type="hidden" name="serial['.$row->mamla_id.']">';
			
			$sub_array = array();  
            $sub_array[] = $row->mamlaNo.$checkBox;  
            $sub_array[] = $row->apilkarirNam;
            $sub_array[] = $row->apilkarirPhone;
            $sub_array[] = $row->protipokherNam;
            $sub_array[] = $row->protipokherPhone;
            $sub_array[] = $row->apilerTarik;
            $sub_array[] = $row->porobortiTarik;
            $data[] = $sub_array;
			
		} // /froeach

		$output = array(
            "draw"				=> intval($_GET["draw"]),  
            "recordsTotal"		=> $this->model_sms->get_all_data(),  
            "recordsFiltered"	=> $this->model_sms->get_filtered_data(),  
            "data"				=> $data  
       	);  

       echo json_encode($output);
	}

	public function fetchSmsModel($id = null)
	{
		if ($id) {
			$smsData = $this->model_sms->smsModel($id);

			$data = array(
				'sms_id'		=> $id,
				'smsDays'		=> html_entity_decode($smsData['send_sms_day']),
				'maskingName' 	=> html_entity_decode($smsData['masking_name']),
				'smsText' 		=> html_entity_decode($smsData['sms'])
			); 

			echo json_encode($data);
		}
	}

	public function sendMessage()
	{
		$validator = array ('success' => false, 'messages' => array());

		$validate_data = array (
			array (
				'field' => 'smsEditor',
				'label' => 'SMS',
				'rules' => 'required'
			),
			array (
				'field' => 'smsDays',
				'label' => 'SMS Day',
				'rules' => 'required|in_list[0,1,2,3,4,5,6,7]',
				'errors' => array(
					'in_list' => "Please, don't edit HTML"
				),
			)
		);

		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true) 
		{
			if (empty($this->input->post('smsModelName'))) 
			{
				$validate_data = array (
					array(
						'field' => 'smsModel',
						'label' => 'SMS Model',
						'rules' => 'required'
					)
				);

				$this->form_validation->set_rules($validate_data);
				$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

				if($this->form_validation->run() === true)
				{
					$sms_model_result = $this->model_sms->updateSmsModel();

					if ($sms_model_result === true)
					{
						$result = $this->smsProcess();

						if ($result === true)
						{
							$validator['success'] 	= true;
							$validator['messages'] 	= "সফল ভাবে এস.এম.এস পাঠান হয়েছে";
						}
						else
						{
							$validator['success'] 	= false;
							$validator['messages'] 	= "দয়া করে যাদের এস.এম.এস পাঠাতে চান, তাদের সিলেক্ট করুন";
						}
					}
					else 
					{
						$validator['success'] 	= false;
						$validator['messages'] 	= "কিছু সমস্যার করনে তথ্য ডাটাবেজ যাচ্ছে না, পুনরায় চেষ্টা করুন";
					}	
				}
				else
				{
					$validator['success'] = false;
					foreach ($_POST as $key => $value)
					{
						$validator['messages'][$key] = form_error($key);
					}
				}
			} 
			else
			{
				$sms_model_result = $this->model_sms->createSMSmodel();

				if ($sms_model_result) {
					$validator['success'] 	= true;
					$validator['messages'] 	= "সফল ভাবে এস.এম.এস মডেল যুক্ত করা হয়েছে";
				}else{
					$validator['success'] 	= false;
					$validator['messages'] 	= "কিছু সমস্যার করনে তথ্য ডাটাবেজ যাচ্ছে না, পুনরায় চেষ্টা করুন";
				}
			}
		}
		else
		{
			$validator['success'] = false;

			foreach ($_POST as $key => $value)
			{
				$validator['messages'][$key] = form_error($key);
			}
		}

		echo json_encode($validator);
	}

	public function smsProcess()
	{
		$mamla_id = $this->input->post('serial');
		
		if (!empty($mamla_id))
		{
			$smsSendDate = (int)$this->input->post('smsDays')*24*60*60;
			foreach ($mamla_id as $key => $value)
			{
				if ($smsSendDate == 0)
				{
					$smsDate = date("Y-m-d");
					$result = $this->model_sms->sendSMS($key, $smsDate);
				} 
				else
				{
					$mamlaDate = $this->model_sms->fatchMamlaDate($key);
					$mamlaDateInTime = strtotime($mamlaDate['porobortiTarik']);
					$sendMsgBefore = $mamlaDateInTime - $smsSendDate;
					$smsDate = date("Y-m-d", $sendMsgBefore);
					$result = $this->model_sms->sendSMS($key, $smsDate);
				}
			}

			return true;
		}
		
		return false;
	}
}