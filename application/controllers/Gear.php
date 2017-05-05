<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Photo extends MY_Controller{

	
	
	
	function __construct(){
	    parent::__construct();
		$this->load->library(array('form_validation', 'table'));
		$this->load->model(array('images', 'albums'));
		$this->load->helper('general');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        
        $data['title']='Gear Calculator - '.$this->config->item('site_title', 'ion_auth');
		
        
        $this->load->vars($data);
		
	}
	
    function index(){
        
        
        $this->load->view('gear_calc', $data);
    }
    
    
    
}