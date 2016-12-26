<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends MY_Controller{

	function __construct(){
	    parent::__construct();
		$this->load->library(array('form_validation', 'table'));
		$this->load->model('posts');
		$this->load->helper('general');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        }
        
       
	public function index(){
		$data['query']=$this->posts->find_all();
		$this->load->view('blog/index',$data);
		
	}
	public function add_new_entry(){
		$this->form_validation->set_rules('entry_name', 'Title', 'required|xss_clean|max_length[200]');
		$this->form_validation->set_rule('entry_body', 'Body', 'required|xss_clean');
		
		if ($this->form_validation->run()==FALSE){
			//not valid
			$this->load->view('blog/add_new_entry');
		}else{
			$name = $this->input->post('entry_name');
			$body= $this->input->post('entry_body');
			$this->blog_model->add_new_entry($name, $body);
			$this->session->set_flashdata('message', '1 New Entry Added!');
			redirect('blog/add_new_entry');
		}
		
		
	}
}