<?php

/**
 * Author: Amirul Momenin
 * Desc:Bill Model
 */
class Bill_model extends CI_Model
{
	protected $bill = 'bill';
	
    function __construct(){
        parent::__construct();
    }
	
    /** Get bill by id
	 *@param $id - primary key to get record
	 *
     */
    function get_bill($id){
        $result = $this->db->get_where('bill',array('id'=>$id))->row_array();
		if(!(array)$result){
			$fields = $this->db->list_fields('bill');
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
	
    /** Get all bill
	 *
     */
    function get_all_bill(){
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('bill')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit bill
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_bill($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $result = $this->db->get('bill')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count bill rows
	 *
     */
	function get_count_bill(){
       $result = $this->db->from("bill")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	
	 /** Get all users-bill
	 *
     */
    function get_all_users_bill(){
        $this->db->order_by('id', 'desc');
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('bill')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit users-bill
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_users_bill($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('bill')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count users-bill rows
	 *
     */
	function get_count_users_bill(){
	   $this->db->where('users_id', $this->session->userdata('id'));
       $result = $this->db->from("bill")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** function to add new bill
	 *@param $params - data set to add record
	 *
     */
    function add_bill($params){
        $this->db->insert('bill',$params);
        $id = $this->db->insert_id();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $id;
    }
	
    /** function to update bill
	 *@param $id - primary key to update record,$params - data set to add record
	 *
     */
    function update_bill($id,$params){
        $this->db->where('id',$id);
        $status = $this->db->update('bill',$params);
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
	
    /** function to delete bill
	 *@param $id - primary key to delete record
	 *
     */
    function delete_bill($id){
        $status = $this->db->delete('bill',array('id'=>$id));
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
}
