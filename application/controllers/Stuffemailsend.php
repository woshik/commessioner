<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stuffemailsend extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->db->select('*');
		$this->db->where('is_send', 0);
		$query = $this->db->get('stuff_email');
		$stuffData = $query->result_array();

		if (count($stuffData) > 0) {

			$config = array();
			$config['protocol']     = 'smtp';
			$config['smtp_host']    = 'mail.cwfap.info';
			$config['smtp_crypto']  = 'ssl';
			$config['smtp_port']    = 465;
			$config['smtp_user']    = 'testmail@cwfap.info';
			$config['smtp_pass']    = 'sszZEw2,6qcf';
			$config['mailtype']     = 'html';
	        $config['charset']      = 'iso-8859-1';
	        $config['wordwrap']     = 'TRUE';

	        $this->load->library('email', $config);

			foreach ($stuffData as $key => $value) {

				$this->email->from($value['sender_email_id'], html_entity_decode($value['sender_name']));
				$this->email->to($value['stuff_email_address']);
		        $this->email->subject(html_entity_decode($value['stuff_email_subject']));
				$this->email->message(html_entity_decode($value['stuff_email_body']));

	        	if (!empty($value['stuff_email_file'])) {

	        		$file = explode(', ', $value['stuff_email_file']);

					foreach ($file as $key => $path) {
						$this->email->attach($path);
					}
				}

				if ($this->email->send()) {
					$update_stuffMail = array (
						'is_send'	=> 1,
					);

					$this->db->where('stuff_email_id', $value['stuff_email_id']);
					$this->db->update('stuff_email', $update_stuffMail);
				}
			}
		}
	}
}