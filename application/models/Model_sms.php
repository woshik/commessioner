<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_sms extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	private $tableName = "mamla";
	private $order_column = array(
		'mamlaNo',
		'apilkarirNam', 
		'apilkarirPhone', 
		'protipokherNam',
		'protipokherPhone',
		'apilerTarik',
		'porobortiTarik', 
	);

	public function fetchSendSmsMamla()
	{
		$sql = "SELECT * FROM mamla WHERE send_sms = ? ORDER BY mamla_id";
		$query = $this->db->query($sql, 0);
		return $query->result_array();
	}

	public function smsModel($id = null)
	{
		if ($id) 
		{
			$sql = "SELECT * FROM sms_model WHERE sms_model_id = ?";
			$query = $this->db->query($sql, $id);
			return $query->row_array();
		} 
		else 
		{
			$sql = "SELECT sms_model_id, sms_model_name FROM sms_model ";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
	}

	public function createSMSmodel()
	{
		$insert_sms_model_data = array (
			'sms_model_name' 	=> htmlentities(trim($this->input->post('smsModelName'))),
			'send_sms_day' 		=> $this->input->post('smsDays'),
			'masking_name'		=> htmlentities(trim($this->input->post('maskingName'))),
			'sms' 				=> htmlentities(trim($this->input->post('smsEditor'))),
		);

		$sms_status = $this->db->insert('sms_model', $insert_sms_model_data);

		return ($sms_status === true  ? true : false);
	}

	public function updateSmsModel()
	{
		$smsModelId = (int) $this->input->post('smsModel');

		if ($smsModelId) 
		{
			$update_sms_model_data = array (
				'send_sms_day' 		=> $this->input->post('smsDays'),
				'masking_name'		=> htmlentities(trim($this->input->post('maskingName'))),
				'sms' 				=> htmlentities(trim($this->input->post('smsEditor'))),
			);	

			$this->db->where('sms_model_id', $smsModelId);
			$update_sms_model_query = $this->db->update('sms_model', $update_sms_model_data);

			return ($update_sms_model_query === true  ? true : false);
		}
	}

	public function sendSMS($id = null, $date = null)
	{
		if ($id && $date) {

			$sms_model_id = $this->input->post('smsModel');

			$update_mamla = array (
				'send_sms'			=> 2,
				'send_sms_date'		=> $date
			);

			$update_send_sms = array (
				'is_send'			=> 2,
				'send_sms_date'		=> $date,
				'sms_model_id'		=> $sms_model_id
			);
			

			$this->db->trans_start();

			$this->db->where('mamla_id', $id);
			$update_mamla_query = $this->db->update('mamla', $update_mamla);

			$this->db->where('mamla_id', $id);
			$update_send_sms_query = $this->db->update('send_sms', $update_send_sms);

			$this->db->trans_complete();

			return (($update_mamla_query === true && $update_send_sms_query === true) ? true : false);
		}	
	}

	public function fatchMamlaDate($id = null)
	{
		$sql = "SELECT porobortiTarik FROM mamla WHERE mamla_id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();
	}

	public function make_query()  
    {  
        $this->db->select("*");  
        $this->db->from($this->tableName);  

        $this->db->group_start();
        $this->db->where('send_sms', 0);
        $this->db->group_end();

        if(isset($_GET["search"]["value"]))
        {
        	$this->db->group_start();
            $this->db->like("mamlaNo", $_GET["search"]["value"]); 
            $this->db->or_like("apilkarirNam", $_GET["search"]["value"]);
            $this->db->or_like("apilkarirPhone", $_GET["search"]["value"]);
            $this->db->or_like("protipokherNam", $_GET["search"]["value"]); 
            $this->db->or_like("protipokherPhone", $_GET["search"]["value"]);
            $this->db->or_like("apilerTarik", $_GET["search"]["value"]);
            $this->db->or_like("porobortiTarik", $_GET["search"]["value"]); 
            $this->db->group_end();
        }  
        if(isset($_GET["order"]))
        {
            $this->db->order_by($this->order_column[$_GET['order']['0']['column']], $_GET['order']['0']['dir']);  
        }  
        else  
        {
        	$this->db->order_by('mamla_id', 'DESC');  
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
}