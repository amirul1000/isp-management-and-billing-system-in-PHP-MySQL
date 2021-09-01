<?php

 /**
 * Author: Amirul Momenin
 * Desc:Customer Controller
 *
 */
class Customer extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('Customlib');
		$this->load->helper(array('cookie', 'url')); 
		$this->load->database();  
		$this->load->model('Customer_model');
		if(! $this->session->userdata('validated')){
				redirect('admin/login/index');
		}  
    } 
	
    /**
	 * Index Page for this controller.
	 *@param $start - Starting of customer table's index to get query
	 *
	 */
    function index($start=0){
		$limit = 10;
        $data['customer'] = $this->Customer_model->get_limit_customer($limit,$start);
		//pagination
		$config['base_url'] = site_url('admin/customer/index');
		$config['total_rows'] = $this->Customer_model->get_count_customer();
		$config['per_page'] = 10;
		//Bootstrap 4 Pagination fix
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tag_close']   = '<span aria-hidden="true"></span></span></li>';
		$config['next_tag_close']   = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tag_close']   = '</span></li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tag_close']  = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tag_close']   = '</span></li>';		
		$this->pagination->initialize($config);
        $data['link'] =$this->pagination->create_links();
		
        $data['_view'] = 'admin/customer/index';
        $this->load->view('layouts/admin/body',$data);
    }
	
	 /**
     * Save customer
	 *@param $id - primary key to update
	 *
     */
    function save($id=-1){   
		 
		$created_at = "";
$updated_at = "";

		if($id<=0){
															 $created_at = date("Y-m-d H:i:s");
														 }
else if($id>0){
															 $updated_at = date("Y-m-d H:i:s");
														 }

		$params = array(
					 'first_name' => html_escape($this->input->post('first_name')),
'last_name' => html_escape($this->input->post('last_name')),
'NID' => html_escape($this->input->post('NID')),
'address' => html_escape($this->input->post('address')),
'service_name' => html_escape($this->input->post('service_name')),
'cost' => html_escape($this->input->post('cost')),
'start_date' => html_escape($this->input->post('start_date')),
'end_date' => html_escape($this->input->post('end_date')),
'created_at' =>$created_at,
'updated_at' =>$updated_at,

				);
		 
		if($id>0){
							                        unset($params['created_at']);
						                          }if($id<=0){
							                        unset($params['updated_at']);
						                          } 
		$data['id'] = $id;
		//update		
        if(isset($id) && $id>0){
			$data['customer'] = $this->Customer_model->get_customer($id);
            if(isset($_POST) && count($_POST) > 0){   
                $this->Customer_model->update_customer($id,$params);
				$this->session->set_flashdata('msg','Customer has been updated successfully');
                redirect('admin/customer/index');
            }else{
                $data['_view'] = 'admin/customer/form';
                $this->load->view('layouts/admin/body',$data);
            }
        } //save
		else{
			if(isset($_POST) && count($_POST) > 0){   
                $customer_id = $this->Customer_model->add_customer($params);
				$this->session->set_flashdata('msg','Customer has been saved successfully');
                redirect('admin/customer/index');
            }else{  
			    $data['customer'] = $this->Customer_model->get_customer(0);
                $data['_view'] = 'admin/customer/form';
                $this->load->view('layouts/admin/body',$data);
            }
		}
        
    } 
	
	/**
     * Details customer
	 * @param $id - primary key to get record
	 *
     */
	function details($id){
        $data['customer'] = $this->Customer_model->get_customer($id);
		$data['id'] = $id;
        $data['_view'] = 'admin/customer/details';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Deleting customer
	 * @param $id - primary key to delete record
	 *
     */
    function remove($id){
        $customer = $this->Customer_model->get_customer($id);

        // check if the customer exists before trying to delete it
        if(isset($customer['id'])){
            $this->Customer_model->delete_customer($id);
			$this->session->set_flashdata('msg','Customer has been deleted successfully');
            redirect('admin/customer/index');
        }
        else
            show_error('The customer you are trying to delete does not exist.');
    }
	
	/**
     * Search customer
	 * @param $start - Starting of customer table's index to get query
     */
	function search($start=0){
		if(!empty($this->input->post('key'))){
			$key =$this->input->post('key');
			$_SESSION['key'] = $key;
		}else{
			$key = $_SESSION['key'];
		}
		
		$limit = 10;		
		$this->db->like('id', $key, 'both');
$this->db->or_like('first_name', $key, 'both');
$this->db->or_like('last_name', $key, 'both');
$this->db->or_like('NID', $key, 'both');
$this->db->or_like('address', $key, 'both');
$this->db->or_like('service_name', $key, 'both');
$this->db->or_like('cost', $key, 'both');
$this->db->or_like('start_date', $key, 'both');
$this->db->or_like('end_date', $key, 'both');
$this->db->or_like('created_at', $key, 'both');
$this->db->or_like('updated_at', $key, 'both');


		$this->db->order_by('id', 'desc');
		
        $this->db->limit($limit,$start);
        $data['customer'] = $this->db->get('customer')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		
		//pagination
		$config['base_url'] = site_url('admin/customer/search');
		$this->db->reset_query();		
		$this->db->like('id', $key, 'both');
$this->db->or_like('first_name', $key, 'both');
$this->db->or_like('last_name', $key, 'both');
$this->db->or_like('NID', $key, 'both');
$this->db->or_like('address', $key, 'both');
$this->db->or_like('service_name', $key, 'both');
$this->db->or_like('cost', $key, 'both');
$this->db->or_like('start_date', $key, 'both');
$this->db->or_like('end_date', $key, 'both');
$this->db->or_like('created_at', $key, 'both');
$this->db->or_like('updated_at', $key, 'both');

		$config['total_rows'] = $this->db->from("customer")->count_all_results();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		$config['per_page'] = 10;
		// Bootstrap 4 Pagination fix
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tag_close']   = '<span aria-hidden="true"></span></span></li>';
		$config['next_tag_close']   = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tag_close']   = '</span></li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tag_close']  = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tag_close']   = '</span></li>';
		$this->pagination->initialize($config);
        $data['link'] =$this->pagination->create_links();
		
		$data['key'] = $key;
		$data['_view'] = 'admin/customer/index';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Export customer
	 * @param $export_type - CSV or PDF type 
     */
	function export($export_type='CSV'){
	  if($export_type=='CSV'){	
		   // file name 
		   $filename = 'customer_'.date('Ymd').'.csv'; 
		   header("Content-Description: File Transfer"); 
		   header("Content-Disposition: attachment; filename=$filename"); 
		   header("Content-Type: application/csv; ");
		   // get data 
		   $this->db->order_by('id', 'desc');
		   $customerData = $this->Customer_model->get_all_customer();
		   // file creation 
		   $file = fopen('php://output', 'w');
		   $header = array("Id","First Name","Last Name","NID","Address","Service Name","Cost","Start Date","End Date","Created At","Updated At"); 
		   fputcsv($file, $header);
		   foreach ($customerData as $key=>$line){ 
			 fputcsv($file,$line); 
		   }
		   fclose($file); 
		   exit; 
	  }else if($export_type=='Pdf'){
		    $this->db->order_by('id', 'desc');
		    $customer = $this->db->get('customer')->result_array();
		   // get the HTML
			ob_start();
			include(APPPATH.'views/admin/customer/print_template.php');
			$html = ob_get_clean();
			require_once FCPATH.'vendor/autoload.php';			
			$mpdf = new \Mpdf\Mpdf();
			$mpdf->WriteHTML($html);
			$mpdf->Output();
			exit;
	  }
	   
	}
}
//End of Customer controller