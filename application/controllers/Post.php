<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends MY_Controller{

	function __construct(){
	    parent::__construct();
		$this->load->library(array('form_validation'));
//		$this->load->helper(array('language'));
//		$this->load->model('stock');
//		$this->load->model('portfolio');
		$this->load->library('table');
//
		$this->form_validation->set_error_delimiters($this->config->item//('error_start_delimiter', 'ion_auth'), $this->config->item//('error_end_delimiter', 'ion_auth'));
        }
        
       
	public function index(){
	    echo "This is a test";
	}