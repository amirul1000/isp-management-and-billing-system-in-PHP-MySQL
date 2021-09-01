<?php

 /**
 * Author: Amirul Momenin
 * Desc:Bill Controller
 *
 */
class Bill extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('Customlib');
		$this->load->helper(array('cookie', 'url')); 
		$this->load->database();  
		$this->load->model('Bill_model');
		if(! $this->session->userdata('validated')){
				redirect('admin/login/index');
		}  
    } 
	
    /**
	 * Index Page for this controller.
	 *@param $start - Starting of bill table's index to get query
	 *
	 */
    function index($start=0){
		$limit = 10;
        $data['bill'] = $this->Bill_model->get_limit_bill($limit,$start);
		//pagination
		$config['base_url'] = site_url('admin/bill/index');
		$config['total_rows'] = $this->Bill_model->get_count_bill();
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
		
        $data['_view'] = 'admin/bill/index';
        $this->load->view('layouts/admin/body',$data);
    }
	
	 /**
     * Save bill
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
					'address' => html_escape($this->input->post('address')),
					'contact' => html_escape($this->input->post('contact')),
					'service_info' => html_escape($this->input->post('service_info')),
					'cost' => html_escape($this->input->post('cost')),
					'bill_for' => html_escape($this->input->post('bill_for')),
					'payment_status' => html_escape($this->input->post('payment_status')),
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
			$data['bill'] = $this->Bill_model->get_bill($id);
            if(isset($_POST) && count($_POST) > 0){   
                $this->Bill_model->update_bill($id,$params);
				$this->session->set_flashdata('msg','Bill has been updated successfully');
                redirect('admin/bill/index');
            }else{
                $data['_view'] = 'admin/bill/form';
                $this->load->view('layouts/admin/body',$data);
            }
        } //save
		else{
			if(isset($_POST) && count($_POST) > 0){   
                $bill_id = $this->Bill_model->add_bill($params);
				$this->session->set_flashdata('msg','Bill has been saved successfully');
                redirect('admin/bill/index');
            }else{  
			    $data['bill'] = $this->Bill_model->get_bill(0);
                $data['_view'] = 'admin/bill/form';
                $this->load->view('layouts/admin/body',$data);
            }
		}
        
    } 
	
	/**
     * Details bill
	 * @param $id - primary key to get record
	 *
     */
	function details($id){
        $data['bill'] = $this->Bill_model->get_bill($id);
		$data['id'] = $id;
        $data['_view'] = 'admin/bill/details';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Deleting bill
	 * @param $id - primary key to delete record
	 *
     */
    function remove($id){
        $bill = $this->Bill_model->get_bill($id);

        // check if the bill exists before trying to delete it
        if(isset($bill['id'])){
            $this->Bill_model->delete_bill($id);
			$this->session->set_flashdata('msg','Bill has been deleted successfully');
            redirect('admin/bill/index');
        }
        else
            show_error('The bill you are trying to delete does not exist.');
    }
	
	/**
     * Search bill
	 * @param $start - Starting of bill table's index to get query
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
		$this->db->or_like('address', $key, 'both');
		$this->db->or_like('contact', $key, 'both');
		$this->db->or_like('service_info', $key, 'both');
		$this->db->or_like('cost', $key, 'both');
		$this->db->or_like('bill_for', $key, 'both');
		$this->db->or_like('payment_status', $key, 'both');
		$this->db->or_like('created_at', $key, 'both');
		$this->db->or_like('updated_at', $key, 'both');


		$this->db->order_by('id', 'desc');
		
        $this->db->limit($limit,$start);
        $data['bill'] = $this->db->get('bill')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		
		//pagination
		$config['base_url'] = site_url('admin/bill/search');
		$this->db->reset_query();		
		$this->db->like('id', $key, 'both');
		$this->db->or_like('first_name', $key, 'both');
		$this->db->or_like('last_name', $key, 'both');
		$this->db->or_like('address', $key, 'both');
		$this->db->or_like('contact', $key, 'both');
		$this->db->or_like('service_info', $key, 'both');
		$this->db->or_like('cost', $key, 'both');
		$this->db->or_like('bill_for', $key, 'both');
		$this->db->or_like('payment_status', $key, 'both');
		$this->db->or_like('created_at', $key, 'both');
		$this->db->or_like('updated_at', $key, 'both');

		$config['total_rows'] = $this->db->from("bill")->count_all_results();
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
		$data['_view'] = 'admin/bill/index';
        $this->load->view('layouts/admin/body',$data);
	}
	
	function print_bill($id){
		    $bill = $this->db->get_where('bill',array('id'=>$id))->row_array();
		   // get the HTML
			ob_start();
			include(APPPATH.'views/admin/bill/print_bill_template.php');
			$html = ob_get_clean();
			require_once FCPATH.'vendor/autoload.php';			
			$mpdf = new \Mpdf\Mpdf();
			$mpdf->WriteHTML($html);
			$mpdf->Output();
			exit;
	}
    /**
     * Export bill
	 * @param $export_type - CSV or PDF type 
     */
	function export($export_type='CSV'){
	  if($export_type=='CSV'){	
		   // file name 
		   $filename = 'bill_'.date('Ymd').'.csv'; 
		   header("Content-Description: File Transfer"); 
		   header("Content-Disposition: attachment; filename=$filename"); 
		   header("Content-Type: application/csv; ");
		   // get data 
		   $this->db->order_by('id', 'desc');
		   $billData = $this->Bill_model->get_all_bill();
		   // file creation 
		   $file = fopen('php://output', 'w');
		   $header = array("Id","First Name","Last Name","Address","Contact","Service Info","Cost","Bill For","Payment Status","Created At","Updated At"); 
		   fputcsv($file, $header);
		   foreach ($billData as $key=>$line){ 
			 fputcsv($file,$line); 
		   }
		   fclose($file); 
		   exit; 
	  }else if($export_type=='Pdf'){
		    $this->db->order_by('id', 'desc');
		    $bill = $this->db->get('bill')->result_array();
		   // get the HTML
			ob_start();
			include(APPPATH.'views/admin/bill/print_template.php');
			$html = ob_get_clean();
			require_once FCPATH.'vendor/autoload.php';			
			$mpdf = new \Mpdf\Mpdf();
			$mpdf->WriteHTML($html);
			$mpdf->Output();
			exit;
	  }
	   
	}
}
//End of Bill controller