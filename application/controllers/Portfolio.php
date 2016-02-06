<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Portfolio extends CI_Controller{

	function __construct(){
	    parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper(array('url','language'));
		$this->load->model('stocks_model');
		$this->load->model('portfolios');

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        
	}
	
	public function index(){
	    if (!$this->ion_auth->logged_in()){	redirect('auth/login', 'refresh');	}
	    if(null!==$this->input->post('submit')){
	    	//fill this section if a certain post value is submitted, like a buy
	    	$stocks_query=array();
	    	foreach($_POST as $symbol){
	    		$stocks_query[] = $symbol;
	    	}
	    	print_r($stocks_query);
	    	
	    }
	    
	    
	    
	    $this->load->library(array('table', 'form_validation'));
	    $this->load->helper('form');
	    
	    
	   
	    $data['porfolio_stocks'] =$this->stocks_model->live_price(array('GE', 'AAPL','TSLA', 'GPRO'));
	    $this->load->view('portfolio', $data);
	    
	   
	}
}
