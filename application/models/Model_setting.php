<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_setting extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function createUser()
	{
		$imgUrl = 'assets/images/default_avatar.png';
		$insert_user_data = array(
			'name' 			=> htmlentities(trim($this->input->post('createAccountName'))),
			'image_src' 	=> $imgUrl,
			'email'			=> htmlentities(strtolower(trim($this->input->post('createAccountEmail')))),
			'username' 		=> htmlentities(strtolower(trim($this->input->post('createAccountUserName')))),
			'password'		=> md5(htmlentities(trim($this->input->post('createAccountPassword')))),
		);

		$user_status = $this->db->insert('login', $insert_user_data);

		return $user_status === true ? true : false;
	}

	public function uploadImg($url=null)
	{
		if ($url) {	
			$insert_img = array(
				'login_img_src' => $url,
			);
			$status = $this->db->insert('login_img', $insert_img);
		}
	}

	public function unlink_photo()
	{
		$this->db->select('login_img_src');
		$query = $this->db->get('login_img');
		$src = $query->result_array();
		foreach ($src as $key => $value) {
			unlink($value['login_img_src']);
		}

		$this->db->empty_table('login_img');
	}
}