<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Portfolios extends CI_Controller{

	function __construct(){
	    parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper(array('language'));
		$this->load->model('stock');
		$this->load->model('portfolio');
		$this->load->library('table');

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        }
        
        
        
	public function index(){
		 if (!$this->ion_auth->logged_in()){	redirect('auth/login', 'refresh');	}
			$this->load->helper('form');
			$this->load->model('ion_auth_model');
		 
		 $data['portfolio_stocks'] = $this->portfolio->find_all();
		 $this->load->view('portfolio', $data);
		
		
		
	}
	
	public function add(){
		
		$this->form_validation->set_rules('portfolio_name', 'Porfolio Name', 'required|is_unique[portfolios.portfolio_name]');
        $this->form_validation->set_rules('beginning_cap', 'Starting Capital', 'required|numeric|greater_than[0]');       
		if($this->form_validation->run()){
			$portfolio = new Portfolio;
			$portfolio->portfolio_name = $this->input->post('portfolio_name');
			$portfolio->portfolio_description = $this->input->post('portfolio_description');
			$portfolio->beginning_cap = $this->input->post('beginning_cap');
			$portfolio->current_cap = $portfolio->beginning_cap;
			$portfolio->starting_date = date("Y-m-d H:i:s");
			$portfolio->user_id = $this->input->post('user_id');
			$portfolio->save();
		}else{
		}
		redirect('portfolios');
		
	}
	public function delete(){
		$id = $this->uri->segment(3);
		$post = Portfolio::find_by_id($id);
		$post->delete();
		redirect('portfolios');
	}
	public function view(){
		$portfolio_id = $this->uri->segment(3);
		$data['portfolio_stocks'] = $this->stock->find_by('portfolio_id', $portfolio_id);
		
		if(null!==$this->input->post('submit_stock_query')){
	    	//fill this section if a certain post value is submitted, like a buy
	    	$stocks_query=array();
	    	foreach($_POST as $symbol){
	    		$stocks_query[] = $symbol;
	    	}
	    	array_pop($stocks_query);
	    	$stocks_query = $this->stock->live_price($stocks_query);
	    	$attributes = array('class' => 'buy-stock', 'id'=>'buy-stock');
	    	for($i=0;$i<count($stocks_query); $i++){
	    		//Add Buy form
	    		$stocks_query[$i]['']= 
	    		form_open('portfolio/buy/id/')
	    		.form_hidden('stock_symbol', $stocks_query[$i]['symbol'])
	    		.form_submit('buy_stock', 'Buy')
	    		.form_close();
	    	}
	    	$data['stocks_query']=$stocks_query;
	    }
	    if(null!==$this->input->post('stock_buy')){
	    	
	    }
	    $this->load->view('stocks', $data);
	}


	public function old(){
	    if (!$this->ion_auth->logged_in()){	redirect('auth/login', 'refresh');	}
	    if(null!==$this->input->post('submit_stock_query')){
	    	echo "TEST";
	    	//fill this section if a certain post value is submitted, like a buy
	    	$stocks_query=array();
	    	foreach($_POST as $symbol){
	    		$stocks_query[] = $symbol;
	    	}
	    	array_pop($stocks_query);
	    	$stocks_query = $this->stock->live_price($stocks_query);
	    	$attributes = array('class' => 'buy-stock', 'id'=>'buy-stock');
	    	for($i=0;$i<count($stocks_query); $i++){
	    		$stocks_query[$i]['']= form_open('portfolio/buy/id').form_submit('buy_stock', 'Buy').form_close();
	    	}
	    	$data['stocks_query']=$stocks_query;
	    }
	    
	    
	    
	    $this->load->library(array('table', 'form_validation'));
	    $this->load->helper('form');
	    
	    
	   
	    $data['portfolio_stocks'] =$this->stock->live_price(array('GE', 'AAPL','TSLA', 'GPRO'));
	    
	    $this->load->view('stocks', $data);
	    
	   
	}
}
