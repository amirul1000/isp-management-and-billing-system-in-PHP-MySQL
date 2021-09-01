<?php

/**
 * Author: Amirul Momenin
 * Desc:Customer Model
 */
class Customer_model extends CI_Model
{
	protected $customer = 'customer';
	
    function __construct(){
        parent::__construct();
    }
	
    /** Get customer by id
	 *@param $id - primary key to get record
	 *
     */
    function get_customer($id){
        $result = $this->db->get_where('customer',array('id'=>$id))->row_array();
		if(!(array)$result){
			$fields = $this->db->list_fields('customer');
			foreach ($fields as $field)
			{
			   $result[$field] = ''; 	  
			}
		}
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    } 
	
    /** Get all customer
	 *
     */
    function get_all_customer(){
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('customer')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit customer
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_customer($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $result = $this->db->get('customer')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count customer rows
	 *
     */
	function get_count_customer(){
       $result = $this->db->from("customer")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	
	 /** Get all users-customer
	 *
     */
    function get_all_users_customer(){
        $this->db->order_by('id', 'desc');
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('customer')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit users-customer
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_users_customer($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('customer')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count users-customer rows
	 *
     */
	function get_count_users_customer(){
	   $this->db->where('users_id', $this->session->userdata('id'));
       $result = $this->db->from("customer")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** function to add new customer
	 *@param $params - data set to add record
	 *
     */
    function add_customer($params){
        $this->db->insert('customer',$params);
        $id = $this->db->insert_id();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $id;
    }
	
    /** function to update customer
	 *@param $id - primary key to update record,$params - data set to add record
	 *
     */
    function update_customer($id,$params){
        $this->db->where('id',$id);
        $status = $this->db->update('customer',$params);
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
	
    /** function to delete customer
	 *@param $id - primary key to delete record
	 *
     */
    function delete_customer($id){
        $status = $this->db->delete('customer',array('id'=>$id));
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
}
