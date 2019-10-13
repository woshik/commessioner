<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sendmessage extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->db->select('*');
		$this->db->where('send_sms', 2);
		$query = $this->db->get('mamla');
		$mamla = $query->result_array();

		if (count($mamla) > 0) {
	 		try
			{ 	
				$query = $this->db->get('bulk_sms');
				$bulk_sms = $query->row_array();

				$userName = $bulk_sms['id'];
				$passWord = $bulk_sms['password'];
				
				$this->load->library("SMSlibrary");
				$soapClient =  new nusoap_client("https://api2.onnorokomSMS.com/sendSMS.asmx?wsdl", 'wsdl');
				//Soap Unicode Support
				$soapClient->soap_defencoding = 'UTF-8';
				$soapClient->decode_utf8 = false;

				$x = 0;

				foreach ($mamla as $key => $clint_info) 
				{
					if ($x >= 200) {
						break;
					}
					
					if (strtotime(date('Y-m-d')) === strtotime($clint_info['send_sms_date'])) 
					{
						$number = $this->convertToeng($clint_info['apilkarirPhone']).', '.$this->convertToeng($clint_info['protipokherPhone']);

						$this->db->select('sms_model_id');
						$this->db->where('mamla_id', $clint_info['mamla_id']);
						$query = $this->db->get('send_sms');
						$model_id = $query->row_array();

						$this->db->select('masking_name, sms');
						$this->db->where('sms_model_id', $model_id['sms_model_id']);
						$query = $this->db->get('sms_model');
						$sms_model = $query->row_array();
						
						$sms = $this->strPurify($sms_model['sms'], $clint_info);

						// One to Many
						$paramArray = array(
							'userName'		=> $userName,
							'userPassword'	=> $passWord, 
							'messageText'	=> $sms, 
							'numberList'	=> $number, 				
							'smsType'		=> "TEXT",
							'maskName'		=> "", 
							'campaignName'	=> "",
						);

						$value = $soapClient->call("OneToMany", $paramArray);			
						$value = explode("||",$value['OneToManyResult']);

						if ((int)$value[0] === 1900)
						{
							$data = array(
							    'send_sms' => 1,
							);

							$this->db->where('mamla_id', $clint_info['mamla_id']);
							$this->db->update('mamla', $data);

							$data = array(
							    'is_send' => 1,
							);

							$this->db->where('mamla_id', $clint_info['mamla_id']);
							$this->db->update('send_sms', $data);
						}
						elseif ((int)$value[0] === 1901) {
							$data = array(
							    'sms_error_log' => 'Parameter content missing',
							);

							$this->db->insert('sms_error_log', $data);
						}
						elseif ((int)$value[0] === 1902) {
							$data = array(
							    'sms_error_log' => 'Invalid user/pass',
							);

							$this->db->insert('sms_error_log', $data);
						}
						elseif ((int)$value[0] === 1903) {
							$data = array(
							    'sms_error_log' => 'Not enough balance',
							);

							$this->db->insert('sms_error_log', $data);
						}
						elseif ((int)$value[0] === 1905) {
							$data = array(
							    'sms_error_log' => 'Invalid destination number - '.$number,
							);

							$this->db->insert('sms_error_log', $data);
						}
						elseif ((int)$value[0] === 1906) {
							$data = array(
							    'sms_error_log' => 'Operator Not found - '.$number,
							);

							$this->db->insert('sms_error_log', $data);
						}
						elseif ((int)$value[0] === 1907) {
							$data = array(
							    'sms_error_log' => 'Invalid mask Name - '.$sms_model['masking_name'],
							);

							$this->db->insert('sms_error_log', $data);
						}
						elseif ((int)$value[0] === 1908) {
							$data = array(
							    'sms_error_log' => 'Sms body too long - '.$number,
							);

							$this->db->insert('sms_error_log', $data);
						}
						elseif ((int)$value[0] === 1909) {
							$data = array(
							    'sms_error_log' => 'Duplicate campaign Name',
							);

							$this->db->insert('sms_error_log', $data);
						}
						elseif ((int)$value[0] === 1910) {
							$data = array(
							    'sms_error_log' => 'Invalid message - '.$number,
							);

							$this->db->insert('sms_error_log', $data);
						}
						elseif ((int)$value[0] === 1911) {
							$data = array(
							    'sms_error_log' => 'Too many Sms Request. Please try less than 500 in one request',
							);

							$this->db->insert('sms_error_log', $data);
						}
					}

					$x++;
				}				
			}
			catch (Exception $e) {
				
			}
		}	
	}

	public function convertToeng($bangla=null)
	{
		if ($bangla) {
			$bangla_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
    		$eng_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0"); 
    		$eng = str_replace($bangla_array, $eng_array, html_entity_decode($bangla));

			return $eng;
		}
	}

	public function strPurify($sms=null ,$clint_info=null)
	{
		if ($sms && $clint_info) {
			$sms = html_entity_decode($sms);
			$sms = strip_tags($sms);
			$sms = $this->strReplace($sms);
			$sms = str_ireplace('[মামলা নং', $clint_info['mamlaNo'], $sms);
			$sms = str_ireplace('[আপীলকারীর নাম', $clint_info['apilkarirNam'], $sms);
			$sms = str_ireplace('[আপীলকারীর ঠিকানা', $clint_info['apilkarirTikana'], $sms);
			$sms = str_ireplace('[আপীলকারীর ফোন নম্বর', $clint_info['apilkarirPhone'], $sms);
			$sms = str_ireplace('[প্রতিপক্ষের নাম', $clint_info['protipokherNam'], $sms);
			$sms = str_ireplace('[প্রতিপক্ষের ঠিকানা', $clint_info['protipokherTikana'], $sms);
			$sms = str_ireplace('[প্রতিপক্ষের ফোন নম্বর', $clint_info['protipokherPhone'], $sms);
			$sms = str_ireplace('[যাহার আদেশের বিরুদ্ধে আপীল', $clint_info['jaharAdese'], $sms);
			$sms = str_ireplace('[যে আদেশের বিরুদ্ধে আপীল', $clint_info['jeAdese'], $sms);
			$sms = str_ireplace('[আপীলদায়ের তারিখ', $clint_info['apilerTarik'], $sms);
			$sms = str_ireplace('[পরবর্তী তারিখ', $clint_info['porobortiTarik'], $sms);
			$sms = str_ireplace('[অএ আদালতের আদেশ', $clint_info['adaloterAdesh'], $sms);
			$sms = str_ireplace('[মামলার বিবরন', $clint_info['mamlarBiboron'], $sms);

			return $sms;
		}
	}

	public function strReplace($sms=null)
	{
		if ($sms) {

			$sms = preg_replace('/[]]/', "\n", $sms);
			$sms = str_replace("&nbsp;", "", $sms);

			return $sms;
		}
	}
}