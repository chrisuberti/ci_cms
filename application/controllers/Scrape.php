<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Scrape extends MY_Controller{

	function __construct(){
	    parent::__construct();
//		$this->load->library(array('form_validation'));
//		$this->load->helper(array('language'));
//		$this->load->model('stock');
//		$this->load->model('portfolio');
//		$this->load->library('table');
//
//		$this->form_validation->set_error_delimiters($this->config->item//('error_start_delimiter', 'ion_auth'), $this->config->item//('error_end_delimiter', 'ion_auth'));
        }
        
       
	public function index(){
	    $url = "http://stocktwits.com/symbol/AAPL";
	    $output = file_get_contents($url);
	    echo $output;
	    
	}
	
	public function test(){
		$this->load->helper('date');
		echo "TEST"."<br>";
		echo time()."<br>";
		
		
		
		$date = strtotime('2011-01-01');
	    $date = date("l", $date);
	    $date = strtolower($date);
		echo date('w', strtotime($date)). "<br>";
		
		echo gmt_to_local(time(), 'UM8', TRUE)."<br>";
		echo unix_to_human(time()); // U.S. time, no seconds
		echo timezone_menu();
		
	}
}