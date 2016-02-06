<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Portfolios extends MY_Model{
    const DB_TABLE = 'portfolios';
    const DB_TABLE_PK = 'id'; //primary key
    
    public $id;
    public $portfolio_name;
    public $current_cap;
    public $last_trade;
    public $user_id;
    
   //public $stocks=array();
    public $yahoo_base_url = "http://finance.yahoo.com/webservice/v1/";
    
    public function __construct(){
        $this->load->library(array('form_validation'));
		$this->load->helper(array('url','language'));
        parent::__construct();
       
    }
    
    public function index($stocks=array()){
       $this->load->
       
       $this->load->view('portfolio');
       
        
    }
    
    
}