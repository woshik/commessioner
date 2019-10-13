<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_mail extends CI_Model {

	private $tableName = "stuff";
	private $order_column = array(
		'',
		'stuff_name', 
		'stuff_phone', 
		'stuff_email', 
	);

	public function __construct()
	{
		parent::__construct();
	}
	
	public function create($img='')
	{
		if (empty($img)) {
			$img = 'assets/images/default_avatar.png';
		}

		$insert_stuff_data = array(
			'stuff_priture' => $img,
			'stuff_name' 	=> htmlentities(trim($this->input->post('stuffName'))),
			'stuff_address'	=> htmlentities(trim($this->input->post('stuffAddress'))),
			'stuff_phone' 	=> htmlentities(trim($this->input->post('stuffPhone'))),
			'stuff_email'	=> htmlentities(trim($this->input->post('stuffEmail'))),
		);

		$stuff_status = $this->db->insert('stuff', $insert_stuff_data);

		return $stuff_status === true ? true : false;
	}

	public function fetchStuffDataById($id=null)
	{
		if ($id) {
			$this->db->select('*');
			$this->db->where('stuff_id', $id);
			$query = $this->db->get('stuff');
			return $query->row_array();
		}
	}

	public function make_query()  
    {  
        $this->db->select("*");  
        $this->db->from($this->tableName);  

        if(isset($_GET["search"]["value"]))
        {
            $this->db->like("stuff_name", $_GET["search"]["value"]); 
            $this->db->or_like("stuff_phone", $_GET["search"]["value"]);
            $this->db->or_like("stuff_email", $_GET["search"]["value"]);
        }  
        if(isset($_GET["order"]))
        {
            $this->db->order_by($this->order_column[$_GET['order']['0']['column']], $_GET['order']['0']['dir']);  
        }  
        else  
        {
        	$this->db->order_by('stuff_id', 'DESC');  
        } 
    }

    public function make_datatables()
    {  
        $this->make_query();  
        if($_GET["length"] != -1)  
        {  
            $this->db->limit($_GET['length'], $_GET['start']);  
        }  
        $query = $this->db->get();  
        return $query->result();  
    }  

    public function get_filtered_data()
    {  
        $this->make_query();  
        $query = $this->db->get();  
        return $query->num_rows();  
   	}

    public function get_all_data()  
    {  
        $this->db->select("*");  
        $this->db->from($this->tableName);  
        return $this->db->count_all_results();  
    }

    public function remove($id=null)
    {
        if ($id) {
            $this->db->where('stuff_id', $id);
            $this->db->delete('stuff');
        }
    }

    public function saveEmail($file_path=null, $data=null, $user=null)
    {
        if ($data && $user) {

            $file = '';
            if (!empty($file_path)) {

                $file = join(", ",$file_path);
            }

            $errorEmail = '';

            $data['emailAddress'] = explode(', ', $data['emailAddress']);

            $insert_stuff_eamil = array(
                'user_id'               => $this->session->userdata('id'),
                'sender_email_id'       => $user['email'],
                'sender_name'           => $user['name'],
                'stuff_email_address'   => '',
                'stuff_email_subject'   => htmlentities($data['emailSubject']),
                'stuff_email_body'      => htmlentities($data['emailBody']),
                'stuff_email_file'      => $file,
            );

            foreach ($data['emailAddress'] as $key => $value) {

                $insert_stuff_eamil['stuff_email_address'] = htmlentities($value);

                $stuff_status = $this->db->insert('stuff_email', $insert_stuff_eamil);

                if ($stuff_status == false) {
                    $errorEmail .= $value.', ';
                }      
            }

            return array('success'=>true, 'error'=>$errorEmail);
        }
    }

    public function sendSMS()
    {
        $smsNumber = explode(', ', trim($this->input->post('phoneNumber')));

        $insert_stuff_sms = array(
            'user_id'           => $this->session->userdata('id'),
            'stuff_sms_phone'   => '',
            'stuff_sms_mask'    => htmlentities(trim($this->input->post('maskingName'))),
            'stuff_sms_body'    => htmlentities(trim($this->input->post('smsBody'))),
        );

        $errorSMS = '';

        foreach ($smsNumber as $key => $value) {
            $insert_stuff_sms['stuff_sms_phone'] = htmlentities($value);
            $stuff_status = $this->db->insert('stuff_sms', $insert_stuff_sms);

            if ($stuff_status == false) {
                $errorSMS .= $value.', ';
            }  
        }
        
        return array('success'=>true, 'error'=>$errorSMS);  
    }
}