<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_dashboard extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function fatchAdminData($id = null)
	{
		if ($id) {
			$sql = "SELECT name,image_src,email,username FROM login WHERE login_id=?";
			$query = $this->db->query($sql, $id);
			return $query->row_array();
		}
	}

	public function updateAdminProfile($userData = null, $imgUrl = null)
	{
		if($userData) {
			if (empty($imgUrl)) {
				$imgUrl = $userData['image_src'];
			}else{
				unlink($userData['image_src']);
			}

			if (!empty($userData['adminCurrentPass']) || !empty($userData['adminNewPass']) || !empty($userData['adminConfirmPass'])) {

				$update_data = array (
					'name' 				=> htmlentities(trim($this->input->post('adminname'))),
					'email' 			=> htmlentities(strtolower(trim($this->input->post('adminEmail')))),
					'password' 			=> md5(htmlentities($userData['adminConfirmPass'])),
					'image_src'			=> $imgUrl
				);
			}
			else{
				$update_data = array (
					'name' 				=> htmlentities(trim($this->input->post('adminname'))),
					'email' 			=> htmlentities(strtolower(trim($this->input->post('adminEmail')))),
					'image_src'			=> $imgUrl
				);
			}
			
			$this->db->where('login_id', $userData['id']);
			$status = $this->db->update('login', $update_data);

			return ($status == true ? true : false);
		}
	}

	public function validate_admin_current_password($password = null, $userId = null)
	{
		if($password && $userId) {			
			$password = md5(htmlentities(trim($this->input->post('adminCurrentPass'))));
			$sql = "SELECT * FROM login WHERE (password = ? AND login_id = ?)";
			$query = $this->db->query($sql, array($password, $userId));
			$result = $query->row_array();
			
			return ($query->num_rows() === 1 ? true : false);			
		}	
		else {
			return false;
		}
	}

	public function fetchUserName($username)
	{
		$username = strtolower(htmlentities(trim($username)));
		
		$sql = "SELECT * FROM login WHERE username = ?";
		$query = $this->db->query($sql, array($username));
		if($query->row_array())
		{
			return true;
		}
		else
		{
			return false;
		}
	}// /validate username function

	public function totalMamla()
	{
		$sql = "SELECT * FROM mamla ";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	public function todayMamla()
	{
		$sql = "SELECT * FROM mamla WHERE apilerTarik=?";
		$query = $this->db->query($sql, date('Y-m-d'));
		return $query->num_rows();
	}

	public function pending()
	{
		$sql = "SELECT * FROM mamla WHERE (send_sms=? OR send_sms=?)";
		$query = $this->db->query($sql, array(0,2));
		return $query->num_rows();
	}
}

?>