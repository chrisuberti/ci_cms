<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{

	function __construct(){
	    parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper(array('url','language'));
		$this->load->model('stocks_model');

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        
	}
	
	public function index(){
	    if (!$this->ion_auth->logged_in()){	redirect('auth/login', 'refresh');	}
	    $this->load->library(array('table', 'form_validation'));
	    $this->load->helper('form');
	    
	    echo form_open("admin/index");
	    $data=array(
	    	'class' 	=>'stocks',
	    	'value' =>'',
	    	'style' =>'',);
	    $num_stocks = 5; 
	    for($i=0;$i<$num_stocks;$i++){
	    	echo form_input(array_merge($data, array('id'=>"stock{$i}")));
	    }
	    echo "<br>".form_submit('submit', 'Get Prices');
	    echo form_close();
	    
	    
	    $stocks =$this->stocks_model->live_price(array('GE', 'AAPL','TSLA', 'GPRO'));
	    $this->table->set_heading(array_keys($stocks[0]));
	    echo $this->table->generate($stocks);
	    
	    
	   
	}
}


//Quandl API key: CYezozBbLyCnAxLTP7YM
