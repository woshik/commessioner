<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_suit extends CI_Model
{

	private $tableName = "mamla";
	private $order_column = array(
		'mamlaNo', 
		'apilkarirNam', 
		'protipokherNam', 
		'apilerTarik',
		'porobortiTarik',
		'send_sms',
		'send_sms_date',
	);

	public function __construct()
	{
		parent::__construct();		
	}
	

	public function create()
	{	
		$porobortiTarik = $this->input->post('porobortiTarik');
		$adaloterAdesh = htmlentities(trim($this->input->post('adaloterAdesh')));

		$insert_mamla_data = array(
			'mamlaNo' 				=> htmlentities(trim($this->input->post('mamlaNo'))),
			'apilkarirNam' 			=> htmlentities(trim($this->input->post('apilkarirNam'))),
			'protipokherNam'		=> htmlentities(trim($this->input->post('protipokherNam'))),
			'jaharAdese' 			=> htmlentities(trim($this->input->post('jaharAdese'))),
			'jeAdese'				=> htmlentities(trim($this->input->post('jeAdese'))),
			'apilerTarik' 			=> $this->input->post('apilerTarik'),
			'porobortiTarik' 		=> $porobortiTarik,
			'adaloterAdesh'			=> $adaloterAdesh,
			'mamlarBiboron'			=> htmlentities(trim($this->input->post('mamlarBiboron'))),
			'apilkarirTikana'		=> htmlentities(trim($this->input->post('apilkarirTikana'))),
			'apilkarirPhone' 		=> htmlentities(trim($this->input->post('apilkarirPhone'))),
			'protipokherTikana'		=> htmlentities(trim($this->input->post('protipokherTikana'))),
			'protipokherPhone'		=> htmlentities(trim($this->input->post('protipokherPhone'))),
			'send_sms' 				=> 0,
			'send_sms_date'			=> '',
		);

		$this->db->trans_start();

		$mamla = $this->db->insert('mamla', $insert_mamla_data);
		$rowID = $this->db->insert_id();

		$insert_tarik_adesh_data = array (
			'mamla_id'			=> $rowID,
			'porobortiTarik' 	=> $porobortiTarik,
			'adaloterAdesh'		=> $adaloterAdesh,
		);
		$mamla_tarik_adesh = $this->db->insert('mamla_tarik_adesh', $insert_tarik_adesh_data);

		$insert_send_sms_data = array (
			'mamla_id'			=> $rowID,
			'is_send' 			=> 0,
			'send_sms_date'		=> '',
		);
		$send_sms = $this->db->insert('send_sms', $insert_send_sms_data);

		$this->db->trans_complete();
		
		if ($mamla === true && $mamla_tarik_adesh === true && $send_sms === true) {
			return true;
		}else{
			return false;
		}
		
	}

	public function fetchSuitDataById($id = null)
	{
		if ($id) {
			$sql = "SELECT * FROM mamla WHERE mamla_id = ?";
			$query = $this->db->query($sql, $id);
			return $query->row_array();
		}
	}

	public function fetchSuitDateAnsOrder($id = null)
	{
		if ($id) {
			$sql = "SELECT * FROM mamla_tarik_adesh WHERE mamla_id = ? ORDER BY mamla_tarik_adesh_id";
			$query = $this->db->query($sql, $id);
			return $query->last_row('array');
		}
	}

	public function DateAndAesh($id = null)
	{
		if ($id) {
			$sql = "SELECT porobortiTarik,adaloterAdesh FROM mamla_tarik_adesh WHERE mamla_id = ? ORDER BY mamla_tarik_adesh_id";
			$query = $this->db->query($sql, $id);
			return $query->result_array();
		}
	}

	public function fetchSendSMS($id = null)
	{
		if ($id) {
			$sql = "SELECT * FROM send_sms WHERE mamla_id = ? ORDER BY send_sms_id";
			$query = $this->db->query($sql, $id);
			return $query->last_row('array');
		}
	}

	public function update($id = null)
	{
		if ($id) {

			$editPorobortiTarik = $this->input->post('editPorobortiTarik');
			$editAdaloterAdesh = htmlentities(trim($this->input->post('editAdaloterAdesh')));

			$this->db->select('porobortiTarik');
			$this->db->where('mamla_id', $id);
			$query = $this->db->get('mamla');
			$date_query = $query->row_array();

			$date_query = strtotime($date_query['porobortiTarik']);
			$edit_date = strtotime($editPorobortiTarik);

			$update_mamla_data = array (
				'apilkarirNam' 			=> htmlentities(trim($this->input->post('editApilkarirNam'))),
				'protipokherNam'		=> htmlentities(trim($this->input->post('editProtipokherNam'))),
				'jaharAdese' 			=> htmlentities(trim($this->input->post('editJaharAdese'))),
				'jeAdese'				=> htmlentities(trim($this->input->post('editJeAdese'))),
				'apilerTarik' 			=> $this->input->post('editApilerTarik'),
				'porobortiTarik' 		=> $editPorobortiTarik,
				'adaloterAdesh'			=> $editAdaloterAdesh,
				'mamlarBiboron'			=> htmlentities(trim($this->input->post('editMamlarBiboron'))),
				'apilkarirTikana'		=> htmlentities(trim($this->input->post('editApilkarirTikana'))),
				'apilkarirPhone' 		=> htmlentities(trim($this->input->post('editApilkarirPhone'))),
				'protipokherTikana'		=> htmlentities(trim($this->input->post('editProtipokherTikana'))),
				'protipokherPhone'		=> htmlentities(trim($this->input->post('editProtipokherPhone'))),
			);

			$update_time_mamla = array(
				'send_sms' 		=> 0,
				'send_sms_date' => ''
			);

			$update_time_send_sms = array(
				'is_send' 		=> 0,
				'send_sms_date' => ''
			);

			$update_tarik_adesh_data = array (
				'porobortiTarik' 	=> $editPorobortiTarik,
				'adaloterAdesh'		=> $editAdaloterAdesh,
			);

			$this->db->select('mamla_tarik_adesh_id');
			$this->db->where('mamla_id', $id);
			$this->db->order_by('porobortiTarik', 'ASC');
			$query = $this->db->get('mamla_tarik_adesh');
			$mamla_tarik = $query->last_row('array');

			$this->db->trans_start();

			$this->db->where('mamla_id', $id);
			$update_mamla_query = $this->db->update('mamla', $update_mamla_data);
				
			if ($date_query != $edit_date) {
				
				$this->db->where('mamla_id', $id);
				$this->db->update('mamla', $update_time_mamla);

				$this->db->where('mamla_id', $id);
				$this->db->update('send_sms', $update_time_send_sms);
			}

			$this->db->where('mamla_tarik_adesh_id', $mamla_tarik['mamla_tarik_adesh_id']);
			$update_tarik_adesh_query = $this->db->update('mamla_tarik_adesh', $update_tarik_adesh_data);

			$this->db->trans_complete();

			if ($update_mamla_query === true && $update_tarik_adesh_query === true) {
				return true;
			}
			else{
				return false;
			}		
		}
	}

	public function remove($id = null)
	{
		if($id) {
			$this->db->trans_start();
			$this->db->where('mamla_id', $id);
			$this->db->delete('mamla');
			$this->db->where('mamla_id', $id);
			$this->db->delete('mamla_tarik_adesh');
			$this->db->where('mamla_id', $id);
			$this->db->delete('send_sms');
			$this->db->trans_complete();
		}
	}

	public function make_query()  
    {  
        $this->db->select("*");  
        $this->db->from($this->tableName);  

        if(isset($_GET["search"]["value"]))
        {
        	$lowercase = strtolower($_GET["search"]["value"]);
        	
            $this->db->like("mamlaNo", $_GET["search"]["value"]); 
            $this->db->or_like("apilkarirNam", $_GET["search"]["value"]);
            $this->db->or_like("protipokherNam", $_GET["search"]["value"]);
            $this->db->or_like("apilerTarik", $_GET["search"]["value"]);
            $this->db->or_like("porobortiTarik", $_GET["search"]["value"]);
            $this->db->or_like("send_sms_date", $_GET["search"]["value"]);

            if ($lowercase === 'sent') {
            	$this->db->or_like("send_sms", 1);
            }elseif($lowercase === 'not sent'){
            	$this->db->or_like("send_sms", 0);
            }
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

    public function updateDateAndAdesh($mamla_id=null, $mamla_date=null)
    {
    	if ($mamla_id && $mamla_date) {

    		$newDate = $this->input->post('newDate');
    		$newAdesh = htmlentities(trim($this->input->post('newAdesh')));

    		if (!empty($newDate) && !empty($newAdesh))
    		{
    			$update_new_date_adesh = array(
    				'porobortiTarik'	=> $newDate,
    				'adaloterAdesh'		=> $newAdesh,
    				'send_sms'			=> 0,
    				'send_sms_date'		=> '',
    			);

    			$update_send_sms = array(
    				'is_send'		=> 0,
    				'send_sms_date'	=> '',
    				'sms_model_id'	=> 0,
    			);

    			$update_mamala_adesh = array(
    				'adaloterAdesh'	=> $newAdesh,
    			);

    			$insert_new_date = array (
					'mamla_id'			=> $mamla_id,
    				'porobortiTarik'	=> $newDate,
    				'adaloterAdesh'		=> ''
    			);

    			$this->db->trans_start();

    			$this->db->where('mamla_id', $mamla_id);
				$update_mamla_query = $this->db->update('mamla', $update_new_date_adesh);

    			$this->db->where('mamla_id', $mamla_id);
				$update_send_sms_query = $this->db->update('send_sms', $update_send_sms);

				$this->db->where('mamla_id', $mamla_id);
    			$this->db->where('porobortiTarik', $mamla_date);
				$update_adesh = $this->db->update('mamla_tarik_adesh', $update_mamala_adesh);

				$insert_new_date = $this->db->insert('mamla_tarik_adesh', $insert_new_date);

				$this->db->trans_complete();

    		}
    		elseif (!empty($newDate) && empty($newAdesh)) {

    			$update_new_date_adesh = array(
    				'porobortiTarik'	=> $newDate,
    				'send_sms'			=> 0,
    				'send_sms_date'		=> '',
    			);

    			$update_send_sms = array(
    				'is_send'		=> 0,
    				'send_sms_date'	=> '',
    				'sms_model_id'	=> 0,
    			);

    			$insert_new_date_adesh = array (
					'mamla_id'			=> $mamla_id,
    				'porobortiTarik'	=> $newDate,
    				'adaloterAdesh'		=> '',
    			);

    			$this->db->trans_start();

    			$this->db->where('mamla_id', $mamla_id);
				$update_mamla_query = $this->db->update('mamla', $update_new_date_adesh);

    			$this->db->where('mamla_id', $mamla_id);
				$update_send_sms_query = $this->db->update('send_sms', $update_send_sms);

				$insert_new_date = $this->db->insert('mamla_tarik_adesh', $insert_new_date_adesh);

				$this->db->trans_complete();
    		}
    		else{
    			$update_new_date_adesh = array(
    				'adaloterAdesh'		=> $newAdesh,
    			);

    			$update_mamala_adesh = array(
    				'adaloterAdesh'	=> $newAdesh,
    			);

    			$this->db->trans_start();

    			$this->db->where('mamla_id', $mamla_id);
				$update_mamla_query = $this->db->update('mamla', $update_new_date_adesh);

    			$this->db->where('mamla_id', $mamla_id);
    			$this->db->where('porobortiTarik', $mamla_date);
				$update_adesh = $this->db->update('mamla_tarik_adesh', $update_mamala_adesh);

				$this->db->trans_complete();
    		}

    		return (($update_mamla_query === true) ? true : false);
    	}
    }
}