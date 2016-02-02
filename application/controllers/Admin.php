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
	    echo "this is a test <br>";
	    //$this->load->view('admin_header');
	    
	    echo "<br><br>";
	    echo $this->stocks_model->live_price(array('GE', 'AAPL','TSLA'));
	    $url = "http://finance.yahoo.com/webservice/v1/symbols/AAPL,GE/quote?format=json";
	    $ch = curl_init($url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	    
	    $results = json_decode(curl_exec($ch), true);
	    
	    
       //$url = "http://stocktwits.com/symbol/TSLA";
       //$ch = curl_init($url);
       
       //curl_setopt($ch, CURLOPT_HEADER, false);
       //$curl_scraped_page = curl_exec($ch);
       curl_close($ch);
       
       echo "<pre>";print_r($results);echo "</pre>";
	   
	   echo "<pre>";
	   print_r($results['list']['resources']['0']['resource']['fields']);
	   echo "</pre>";
	}
}


//Quandl API key: CYezozBbLyCnAxLTP7YM
