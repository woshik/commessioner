<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_login extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function login() 
	{
		$username = strtolower(htmlentities(trim($this->input->post('username'))));
		$password = md5(htmlentities(trim($this->input->post('password'))));

		if($username && $password) {

			$sql = "SELECT login_id FROM login WHERE (username = ? AND password = ?)";
			$query = $this->db->query($sql, array($username, $password));
			$result = $query->row_array();
			
			if($query->num_rows() === 1) {
				
				$admin_data = array(
					'id'				=> $result['login_id'],
					'account_access'	=> TRUE
				);

				$this->session->set_userdata($admin_data);
				
				return true;
			}else{
				return false;
			}
		}
		else {
			return false;
		}
	}

	public function checkMail()
	{
		$username = htmlentities(strtolower(trim($this->input->post('username'))));
		$this->db->select('*');
		$this->db->where('username',$username);
		$query = $this->db->get('login');
		$login_data = $query->row_array();

		if ($login_data['login_id']) {
			$code = md5(uniqid());

			$recover_code = array(
				'recover_code'	=> $code,
			);

			$this->db->where('login_id', $login_data['login_id']);
			$status = $this->db->update('login', $recover_code);

			if ($status === true) {
				$this->sendMail($login_data, $code);
				return array('pass'=>true, 'id'=>$login_data['login_id']);
			}
		}
		else{
			return false;
		}
	}

	public function checkpasscode()
	{
		$id = htmlentities(trim($this->input->post('hiddenmailId')));
		$code = htmlentities(trim($this->input->post('passcode')));

		$this->db->select('recover_code');
		$this->db->where('login_id',$id);
		$this->db->where('recover_code',$code);
		$query = $this->db->get('login');
		$row = $query->num_rows();

		if ($row === 1) {
			return array('pass'=>true, 'id'=>$id);
		}else{
			return false;
		}
	}

	public function changePassword()
	{
		$password = md5(htmlentities(trim($this->input->post('newpass'))));
		$id = htmlentities(trim($this->input->post('hiddenmailId')));

		$update = array(
			'password'	=> $password
		);

		$this->db->where('login_id', $id);
		$query = $this->db->update('login', $update);

		if ($query === true) {
			return true;
		}else{
			return false;
		}
	}

	public function img_num()
	{
		$this->db->select('*');
		$query = $this->db->get('login_img');
		return $query->num_rows();
	}

	public function img_src()
	{
		$this->db->select('login_img_src');
		$query = $this->db->get('login_img');
		return $query->result_array();
	}

	public function sendMail($data = null, $code=null)
	{
		if($code){
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

			$this->email->from('testmail@cwfap.info', 'Onik');
			$this->email->to($data['email']);
			$this->email->subject('Recover Code');
			$this->email->message('Your recode code is : '.$code);
			$this->email->send();
		}
	}
}

?>