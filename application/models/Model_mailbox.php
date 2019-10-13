<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_mailbox extends CI_Model {

	private $EmailtableName = "stuff_email";
	private $Email_order_column = array(
		'stuff_email_address',
		'', 
		'dateTime', 
	);

    private $SMStableName = "stuff_sms";
    private $SMS_order_column = array(
        'stuff_sms_phone',
        '', 
        '', 
        'dateTime', 
    );

	public function __construct()
	{
		parent::__construct();
	}
	
	public function fetchEmailDataById($id=null)
	{
		if ($id) {
			$this->db->select('*');
			$this->db->where('stuff_id', $id);
			$query = $this->db->get('stuff');
			return $query->row_array();
		}
	}

	public function make_email_query()  
    {  
        $this->db->select("*");  

        $this->db->from($this->EmailtableName); 

        $this->db->group_start();
        $this->db->where('is_send', 1);
        $this->db->group_end();

        if(isset($_GET["search"]["value"]))
        {
            $this->db->group_start();
            $this->db->like("stuff_email_address", $_GET["search"]["value"]); 
            $this->db->or_like("dateTime", $_GET["search"]["value"]);
            $this->db->group_end();
        }  
        if(isset($_GET["order"]))
        {
            $this->db->order_by($this->Email_order_column[$_GET['order']['0']['column']], $_GET['order']['0']['dir']);  
        }  
        else  
        {
        	$this->db->order_by('dateTime', 'DESC');
        } 
    }

    public function make_email_datatables()
    {  
        $this->make_email_query();  
        if($_GET["length"] != -1)  
        {  
            $this->db->limit($_GET['length'], $_GET['start']);  
        }  

        $query = $this->db->get();  
        return $query->result();  
    }  

    public function get_email_filtered_data()
    {  
        $this->make_email_query();  
        $query = $this->db->get();  
        return $query->num_rows();  
   	}

    public function get_email_all_data()  
    {  
        $this->db->select("*");
        $this->db->where('is_send', 1);
        $this->db->from($this->EmailtableName);  
        return $this->db->count_all_results();  
    }

    /*Sms data table*/

    public function make_sms_query()  
    {  
        $this->db->select("*");  
        $this->db->from($this->SMStableName);  

        $this->db->group_start();
        $this->db->where('is_send', 1);
        $this->db->group_end();

        if(isset($_GET["search"]["value"]))
        {
            $this->db->group_start();
            $this->db->like("stuff_sms_phone", $_GET["search"]["value"]); 
            $this->db->or_like("dateTime", $_GET["search"]["value"]);
            $this->db->group_end();
        }  
        if(isset($_GET["order"]))
        {
            $this->db->order_by($this->SMS_order_column[$_GET['order']['0']['column']], $_GET['order']['0']['dir']);  
        }  
        else  
        {
            $this->db->order_by('dateTime', 'DESC');
        } 
    }

    public function make_sms_datatables()
    {  
        $this->make_sms_query();  
        if($_GET["length"] != -1)  
        {  
            $this->db->limit($_GET['length'], $_GET['start']);  
        }
        $query = $this->db->get();  
        return $query->result();  
    }  

    public function get_sms_filtered_data()
    {  
        $this->make_sms_query();  
        $query = $this->db->get();  
        return $query->num_rows();  
    }

    public function get_sms_all_data()  
    {  
        $this->db->select("*");
        $this->db->where('is_send', 1);
        $this->db->from($this->SMStableName);  
        return $this->db->count_all_results();  
    }

}