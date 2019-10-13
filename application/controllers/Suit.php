<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suit extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		// loading the suit model	
		$this->load->model('model_suit');
	}

	public function index()
	{
		if($this->isLoggedIn()) {
			$data = array("page_section" => "মামলা নিয়ন্ত্রণ", "toggle" => "active", 'userInfo' => $this->userInfo);
			$this->load->view('dashboard_layout',$data);	
		}
		else {
			redirect(base_url('login/?logged_in_first'));
		}
	}

	public function createSuitPage()
	{
		if($this->isLoggedIn()) {
			$data = array("page_section" => "মামলা ফরম", "toggle" => "active", 'userInfo' => $this->userInfo);
			$this->load->view('dashboard_layout',$data);	
		}
		else {
			redirect(base_url('login/?logged_in_first'));
		}
	}

	public function fetchSuitData($suitId = null)
	{
		if($suitId) {
			$suitData = $this->model_suit->fetchSuitDataById($suitId);
			$dateAdesh = $this->model_suit->DateAndAesh($suitId);
			$result = array(
				'mamla_id'			=> html_entity_decode($suitData['mamla_id']),
				'mamlaNo' 			=> html_entity_decode($suitData['mamlaNo']),
				'apilkarirNam' 		=> html_entity_decode($suitData['apilkarirNam']),
				'protipokherNam' 	=> html_entity_decode($suitData['protipokherNam']),
				'jaharAdese' 		=> html_entity_decode($suitData['jaharAdese']),
				'jeAdese' 			=> html_entity_decode($suitData['jeAdese']),
				'apilerTarik' 		=> $suitData['apilerTarik'],
				'tarikAdesh' 		=> $dateAdesh,
				'mamlarBiboron' 	=> html_entity_decode($suitData['mamlarBiboron']),
				'apilkarirTikana' 	=> html_entity_decode($suitData['apilkarirTikana']),
				'apilkarirPhone' 	=> html_entity_decode($suitData['apilkarirPhone']),
				'protipokherTikana' => html_entity_decode($suitData['protipokherTikana']),
				'protipokherPhone' 	=> html_entity_decode($suitData['protipokherPhone']),
			);

			echo json_encode($result);
		}
		else {
			$fetch_data = $this->model_suit->make_datatables();  
           	$data = array();
           	$sms_state = '';

           	foreach($fetch_data as $row)  
           	{
           		$btn = '<input type="hidden" value="'.$row->mamla_id.'"/>
           		<div class="btn-group">
						  <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    Option <span class="caret"></span>
						  </button>
						  <ul class="dropdown-menu">
						  <li><a href="#" type="button" data-toggle="modal" data-target="#showDetails" onclick="showDetails('.$row->mamla_id.')" data-backdrop="static"><i class="fas fa-eye"></i> সকল তথ্য</a></li>
					      <li><a href="#" type="button" data-toggle="modal" data-target="#editSuit" onclick="editSuit('.$row->mamla_id.')" data-backdrop="static"><i class="fas fa-edit"></i> তথ্য পরিবর্তন</a></li>
					      <li><a href="#" type="button" data-toggle="modal" data-target="#newDateAndAdesh" onclick="newDateAndAdesh('.$row->mamla_id.')" data-backdrop="static"><i class="far fa-calendar-alt"></i> মামলার নতুন তারিখ ও <br> <span style="margin-left: 17px;">আদালতের আদেশ</span> </a></li>
						  </ul>
						</div>';

           		if ((int)$row->send_sms === 0) {
					$sms_state = 'Not Sent';
				} elseif ((int)$row->send_sms === 1) {
					$sms_state = 'Sent';
				} elseif ((int)$row->send_sms === 2){
					$sms_state = 'Pending';
				}

                $sub_array = array();
                $sub_array[] = $row->mamlaNo;  
                $sub_array[] = $row->apilkarirNam;
                $sub_array[] = $row->protipokherNam;   
                $sub_array[] = $row->apilerTarik;
                $sub_array[] = $row->porobortiTarik;
                $sub_array[] = $sms_state;
                $sub_array[] = $row->send_sms_date;
                $sub_array[] = $btn;
                $data[] = $sub_array;
  
           	}  
           	$output = array (  
                "draw"				=> intval($_GET["draw"]),  
                "recordsTotal"		=> $this->model_suit->get_all_data(),  
                "recordsFiltered"	=> $this->model_suit->get_filtered_data(),  
                "data"				=> $data  
           	);  

           echo json_encode($output);
		} // /else
	}

	public function create()
	{
		$validator = array('success' => false, 'messages' => array());
		
		$validate_data = array(
			array(
				'field' => 'mamlaNo',
				'label' => 'mamlaNo',
				'rules' => 'required|is_unique[mamla.mamlaNo]',
				'errors' => array(
                	'required' => 'মামলা নং পূরণ করুন',
                	'is_unique'=> 'এই নম্বরের মামলা ইতিমধ্যে যুক্ত করা হয়েচ্ছে । মামলা নম্বর পরিবর্তন করুন ।'
                ),
			),
			array(
				'field' => 'apilkarirNam',
				'label' => 'apilkarirNam',
				'rules' => 'required',
				'errors' => array(
                	'required' => 'আপীলকারীর নাম পূরণ করুন ।',
                ),
			),
			array(
				'field' => 'protipokherNam',
				'label' => 'protipokherNam',
				'rules' => 'required',
				'errors' => array(
                	'required' => 'প্রতিপক্ষের নাম পূরণ করুন ।',
                ),
			),
			array(
				'field' => 'apilerTarik',
				'label' => 'apilerTarik',
				'rules' => 'required|callback_validate_date',
				'errors' => array(
                	'required' => 'আপীলদায়ের তারিখ পূরণ করুন ।',
                ),
			),
			array(
				'field' => 'porobortiTarik',
				'label' => 'porobortiTarik',
				'rules' => 'required|callback_validate_edit_date['.$this->input->post('apilerTarik').']',
				'errors' => array(
                	'required' => 'পরবর্তী তারিখ পূরণ করুন ।',
                ),
			),
			array(
				'field' => 'apilkarirPhone',
				'label' => 'apilkarirPhone',
				'rules' => 'required',
				'errors' => array(
                	'required' => 'আপীলকারীর ফোন নম্বর পূরণ করুন ।',
                ),
			),
			array(
				'field' => 'protipokherPhone',
				'label' => 'protipokherPhone',
				'rules' => 'required',
				'errors' => array(
                	'required' => 'প্রতিপক্ষের ফোন নম্বর পূরণ করুন ।',
                ),
			)
		);

		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true) {	
			$create = $this->model_suit->create();					
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

	public function edit($suitId = null)
	{
		if ($suitId) {
			$validator = array('success' => false, 'messages' => array());
		
			$validate_data = array(
				array(
					'field' => 'editApilkarirNam',
					'label' => 'editApilkarirNam',
					'rules' => 'required',
					'errors' => array(
	                	'required' => 'আপীলকারীর নাম পূরণ করুন ।',
	                ),
				),
				array(
					'field' => 'editProtipokherNam',
					'label' => 'editProtipokherNam',
					'rules' => 'required',
					'errors' => array(
	                	'required' => 'প্রতিপক্ষের নাম পূরণ করুন ।',
	                ),
				),
				array(
					'field' => 'editApilerTarik',
					'label' => 'editApilerTarik',
					'rules' => 'required|callback_validate_edit_apil_date['.$suitId.']',
					'errors' => array(
	                	'required' => 'আপীলদায়ের তারিখ পূরণ করুন ।',
	                ),
				),
				array(
					'field' => 'editPorobortiTarik',
					'label' => 'editPorobortiTarik',
					'rules' => 'required|callback_validate_edit_date['.$this->input->post('editApilerTarik').']',
					'errors' => array(
	                	'required' => 'পরবর্তী তারিখ পূরণ করুন ।',
	                ),
				),
				array(
					'field' => 'editApilkarirPhone',
					'label' => 'editApilkarirPhone',
					'rules' => 'required',
					'errors' => array(
	                	'required' => 'আপীলকারীর ফোন নম্বর পূরণ করুন ।',
	                ),
				),
				array(
					'field' => 'editProtipokherPhone',
					'label' => 'editProtipokherPhone',
					'rules' => 'required',
					'errors' => array(
	                	'required' => 'প্রতিপক্ষের ফোন নম্বর পূরণ করুন ।',
	                ),
				)
			);

			$this->form_validation->set_rules($validate_data);
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

			if($this->form_validation->run() === true) {
				$create = $this->model_suit->update($suitId);					
				if($create === true) {
					$validator['success'] = true;
					$validator['messages'] = "তথ্য পরিবর্তন করা হয়েচ্ছে";
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
	}

	public function remove($suitId = null)
	{
		if($suitId) {
			$this->model_suit->remove($suitId);
		}
	}

	public function newDateAndAdesh($mamla_id=null)
	{
		if ($mamla_id) {
			$validator = array('success' => false, 'messages' => array());
			$suitData = $this->model_suit->fetchSuitDataById($mamla_id);
			
			if (!empty(trim($this->input->post('newDate')))) {
				$validate_data = array(
					array(
						'field' => 'newDate',
						'label' => 'new Date',
						'rules' => 'required|callback_validate_new_date['.$suitData['porobortiTarik'].']',
						'errors' => array(
	                		'required' => 'মামলার তারিখ পূরণ করুন ।',
	                	),
					),
				);
			}
			else {
				$validate_data = array(
					array(
						'field' => 'newAdesh',
						'label' => 'newAdesh',
						'rules' => 'required',
						'errors' => array(
	                		'required' => 'আদালতের আদেশ পূরণ করুন ।',
	                	),
					),
				);
			}

			$this->form_validation->set_rules($validate_data);
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

			if($this->form_validation->run() === true) {
				$create = $this->model_suit->updateDateAndAdesh($mamla_id, $suitData['porobortiTarik']);					
				if($create === true) {
					$validator['success'] = true;
					$validator['messages'] = "নতুন মামলার তারিখ যুক্ত করা হয়েচ্ছে";
				}
				else {
					$validator['success'] = false;
					$validator['messages'] = "কিছু সমস্যার করনে নতুন মামলার তারিখ যুক্ত যাচ্ছে না, পুনরায় চেষ্টা করুন";
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
	}

	public function validate_new_date($newDate=null, $porobortiTarik=null)
	{
		if($newDate && $porobortiTarik)
		{
			$newMamlaDate = strtotime($newDate);
			$mamlaDate = strtotime($porobortiTarik);
			
			if ($mamlaDate<$newMamlaDate) {
				return true;
			}
			else {
				$this->form_validation->set_message('validate_new_date', 'অনুগ্রহ করে '.$porobortiTarik.' এর পরবর্তী তারিখ প্রবেশ করান');
				return false;			
			}
		}
	}

	public function validate_date($porobortiTarik=null)
	{
		if ($porobortiTarik) {
			$Date = strtotime($porobortiTarik);
			$today = strtotime(date('Y-m-d'));

			if ($today<=$Date) {
				return true;
			}
			else {
				$this->form_validation->set_message('validate_date', 'অনুগ্রহ করে '.date('Y-m-d').' অথবা এর পরবর্তী তারিখ প্রবেশ করান');
				return false;			
			}
		}
	}

	public function validate_edit_date($editporobortiTarik=null, $editApilerTarik=null)
	{
		if ($editporobortiTarik && $editApilerTarik) {
			$editporobortiTarik = strtotime($editporobortiTarik);
			$ApilerTarik = strtotime($editApilerTarik);

			if ($ApilerTarik<=$editporobortiTarik) {
				return true;
			}
			else{
				$this->form_validation->set_message('validate_edit_date', 'অনুগ্রহ করে '.$editApilerTarik.' অথবা এর পরবর্তী তারিখ প্রবেশ করান');
				return false;
			}
		}
	}

	public function validate_edit_apil_date($editApilerTarik=null, $suitId=null)
	{
		if ($editApilerTarik && $suitId) {
			$suitData = $this->model_suit->fetchSuitDataById($suitId);
			$editApilerTarik = strtotime($editApilerTarik);
			$suitApilDate = strtotime($suitData['apilerTarik']);

			if ($editApilerTarik === $suitApilDate) {
				return true;
			}
			else{
				$today = strtotime(date('Y-m-d'));

				if ($editApilerTarik >= $today) {
					return true;
				}
				else{
					$this->form_validation->set_message('validate_edit_apil_date', 'অনুগ্রহ করে '.date('Y-m-d').' অথবা এর পরবর্তী তারিখ প্রবেশ করান');
					return false;
				}
			}
		}
	}

	public function createPDF($id=null)
	{
		if ($id) {
			$suitData = $this->model_suit->fetchSuitDataById($id);
			$path = base_url('assets/fonts/siyam-rupali/stylesheet.css');
			$img = base_url('assets/images/logo.png');
			$output = '
				<!DOCTYPE html>
				<html>
					<head>
						<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
						<link href="'.$path.'" rel="stylesheet">
						<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
						<style>
							body{
								width: 960px;
								margin: 10px auto;
								border: 2px solid black;
								padding: 15px;
							}
						</style>
					</head>
					
					<body onload="window.print();">
						<div class="container">
							<div class="text-center mb-5">
								<img src="'.$img.'" height="150px" width="150px">
							</div>

							<table width="100%" cellspacing="5" cellpadding="5">
								<tr>
							    	<td width="75%">
								    <p><b>মামলা নং : </b>'.$suitData['mamlaNo'].'</p>
								    <p><b>আপীলকারীর নাম : </b>'.$suitData['apilkarirNam'].'</p>
								    <p><b>আপীলকারীর ঠিকানা : </b>'.$suitData['apilkarirTikana'].'</p>
								    <p><b>আপীলকারীর ফোন নম্বর : </b>'.$suitData['apilkarirPhone'].'</p>
								    <p><b>প্রতিপক্ষের নাম : </b> '.$suitData['protipokherNam'].' </p>
								    <p><b>প্রতিপক্ষের ঠিকানা : </b>'.$suitData['apilkarirTikana'].'</p>
								    <p><b>প্রতিপক্ষের ফোন নম্বর : </b>'.$suitData['apilkarirPhone'].'</p>
								    <p><b>যাহার আদেশের বিরুদ্ধে আপীল : </b>'.$suitData['jaharAdese'].'</p>
							     	<p><b>যে আদেশের বিরুদ্ধে আপীল : </b>'.$suitData['jeAdese'].'</p>
								    <p><b>আপীলদায়ের তারিখ : </b> '.$suitData['apilerTarik'].' </p>
								    <p><b>পরবর্তী তারিখ : </b>'.$suitData['porobortiTarik'].'</p>
								    <p><b>অএ আদালতের আদেশ : </b>'.$suitData['adaloterAdesh'].'</p>
								    <p><b>মামলার বিবরন : </b>'.$suitData['mamlarBiboron'].'</p>
							    	</td>
								</tr>
							</table>
						</div>
						
						<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
						<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
						<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
					</body>
				</html>';
				
			echo $output;
		}
	}
}