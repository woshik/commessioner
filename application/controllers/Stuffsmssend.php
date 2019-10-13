<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stuffsmssend extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->db->select('*');
		$this->db->where('is_send', 0);
		$query = $this->db->get('stuff_sms');
		$stuffSMS = $query->result_array();

		if (count($stuffSMS)) {
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

				foreach ($stuffSMS as $key => $smsInfo) 
				{
					if ($x >= 200) {
						break;
					}
				
					$number = $this->convertToeng($smsInfo['stuff_sms_phone']);
						
					$sms = $this->strPurify($smsInfo['stuff_sms_body']);

					echo $sms;
					// One to Many
					$paramArray = array(
						'userName'		=> $userName,
						'userPassword'	=> $passWord,
						'messageText'	=> $sms, 
						'numberList'	=> $number, 				
						'smsType'		=> "TEXT",
						'maskName'		=> $smsInfo['stuff_sms_mask'], 
						'campaignName'	=> "",
					);

					$value = $soapClient->call("OneToMany", $paramArray);			
					$value = explode("||",$value['OneToManyResult']);

					if ((int)$value[0] === 1900) {
						$update_stuffsms = array (
							'is_send'	=> 1,
						);

						$this->db->where('stuff_sms_id', $value['stuff_sms_id']);
						$this->db->update('stuff_sms', $update_stuffsms);
						
					}
					/*elseif ((int)$value[0] === 1901) {
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
					}*/
				}

				$x++;
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

	public function strPurify($sms=null)
	{
		if ($sms) {
			$sms = html_entity_decode($sms);
			$sms = strip_tags($sms);
			$sms = str_replace("&nbsp;", "", $sms);
			return $sms;
		}
	}
}

	
