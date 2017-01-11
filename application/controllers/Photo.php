<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Photo extends MY_Controller{
	var $data;
	
	
	
	function __construct(){
	    parent::__construct();
		$this->load->library(array('form_validation', 'table'));
		$this->load->model(array('images'));
		$this->load->helper('general');
		$this->load->library('upload');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        
        
		
		
	}
        
        public function index(){
        	$data['max_file_size'] = 20 * 1048576;
        	if (!$this->ion_auth->logged_in()){
				redirect('auth/login', 'refresh');
			}else{
			
				$data['title']='Upload Photo - '.$this->config->item('site_title', 'ion_auth');
				$this->load->view('auth/blog/photo_upload', $data);
			
			}
        }
        public function add_photo(){
        	if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
			}else{
				if(!empty($_POST)){	
					
					$config['upload_path']          = './uploads/';
                	$config['allowed_types']        = 'gif|jpg|png';
                	$config['max_size']             = 100;
                	$config['max_width']            = 1024;
                	$config['max_height']           = 768;
                	
                	
					$this->load->library('upload', $config);

				}
				
        }
        }
}